<?php

namespace Wbc\AdministratorBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wbc\AdministratorBundle\Entity\Producto;
use Wbc\AdministratorBundle\Form\ProductoType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Wbc\AdministratorBundle\Model\Cliente;
use Wbc\AdministratorBundle\Model\Gerente;
use Wbc\AdministratorBundle\Model\EncargadoLogistica;
use Wbc\AdministratorBundle\Entity\Venta;

/**
 * Producto controller.
 *
 */
class ProductoController extends Controller {

    /**
     * Lists all Producto entities.
     *
     */
    public function indexAction() {
        $this->get('Services')->setMenuItem('Producto');
        $em = $this->getDoctrine()->getManager();
        $gerente = new Gerente($em);

        $productos = $gerente->generarReporteCompras();

        return $this->render('producto/index.html.twig', array(
                    'productos' => $productos,
        ));
    }

    /**
     * Generaicion de reporte de facturas
     * @return array
     */
    public function ventasAction() {
        $this->get('Services')->setMenuItem('Ventas');
        $em = $this->getDoctrine()->getManager();
        $encargadoLogistica = new EncargadoLogistica($em);

        $productos = $encargadoLogistica->generarReporteDeVentas();

        return $this->render('producto/ventas.html.twig', array(
                    'productos' => $productos,
        ));
    }

    /**
     * Listado de productos comprados segun factura
     * @param Venta $Venta
     * @return array
     */
    public function showventaAction(Venta $Venta) {

        $em = $this->getDoctrine()->getManager();
        $gerente = new Gerente($em);
        $productos = $gerente->generarReporteDeVentas($Venta->getId());

        $this->get('Services')->setMenuItem('Listado de Productos comprados por factura');
        $changes = $this->get('Services')->getLogsByEntity($Venta);

        return $this->render('producto/showventa.html.twig', array(
                    'productos' => $productos,
                    'changes' => $changes,
        ));
    }

    /**
     * Creates a new Producto entity.
     *
     */
    public function newAction(Request $request) {
        $this->get('Services')->setMenuItem('Producto');

        $producto = new Producto();
        $form = $this->createForm('Wbc\AdministratorBundle\Form\ProductoType', $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $productoClass = new \Wbc\AdministratorBundle\Model\Producto($em);
            $productoClass->Comprar($producto); //flush new product

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Producto created!'));

            return $this->redirectToRoute('producto_index');
        }

        return $this->render('producto/new.html.twig', array(
                    'producto' => $producto,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Producto entity.
     *
     */
    public function showAction(Producto $producto) {

        $em = $this->getDoctrine()->getManager();
        $cliente = new Cliente($this->getUser(), $em);
        $productoDetalle = $cliente->consultarProducto($producto->getId());

        $this->get('Services')->setMenuItem('Producto');
        $changes = $this->get('Services')->getLogsByEntity($producto);

        return $this->render('producto/show.html.twig', array(
                    'producto' => $productoDetalle,
                    'changes' => $changes,
        ));
    }

    /**
     * Displays a form to edit an existing Producto entity.
     *
     */
    public function editAction(Request $request, Producto $producto) {
        $this->get('Services')->setMenuItem('Producto');
        $editForm = $this->createForm('Wbc\AdministratorBundle\Form\ProductoType', $producto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $productoClass = new \Wbc\AdministratorBundle\Model\Producto($em);
            $productoClass->administrarProducto($producto);  // flush product edit

            $this->get('Services')->addFlash('success', $this->get('translator')->trans('Producto updated!'));

            return $this->redirectToRoute('producto_index');
        }

        return $this->render('producto/edit.html.twig', array(
                    'producto' => $producto,
                    'form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a Producto entity.
     *
     */
    public function deleteAction(Request $request, Producto $producto) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($producto);
        $em->flush();

        $this->get('Services')->setFlash('danger', $this->get('translator')->trans('Producto deleted!'));

        return $this->redirectToRoute('producto_index');
    }

    /**
     * Proceso de carrito de compras
     * @param Request $request
     * @return JsonResponse
     */
    public function comprarProductoAction(Request $request) {

        $em = $this->getDoctrine()->getManager();

        try {
            $params = json_decode($request->getContent());

            $cliente = new Cliente($this->getUser(), $em);

            $comprarProductos = $cliente->comprarPruductos($params->productoChecked);


            if ($comprarProductos === false) {
                $code = 500;
                $response = array('msg' => 'Internal Error', 'code' => $code, 'recordset' => null, 'error' => $cliente->errorMessage);
            } else {
                $code = 200;
                $response = array('msg' => 'Ok, Course assignment successfully', 'code' => $code, 'recordset' => $comprarProductos, 'error' => null);
            }
        } catch (Exception $ex) {
            $code = 404;
            $response = array('msg' => 'Not found', 'code' => $code, 'recordset' => null, 'error' => $ex->getMessage());
        }

        return new JsonResponse($response, $code);
    }

}
