<?php

namespace Wbc\APIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * This is an example of Nelmio API Documentation.
     * You can find more information here:
     * https://github.com/nelmio/NelmioApiDocBundle/blob/master/Resources/doc/the-apidoc-annotation.md
     *
     * @ApiDoc(
     *  resource=true,
     *  description="API Index endpint",
     *  filters={
     *      {"name"="pretty", "dataType"="string", "pattern"="(true|false)"}
     *  }
     * )
     */

    public function indexAction(Request $request)
    {
        $pretty = $request->get('pretty', 'false');

        $recordSet = array (
          'type' => 'info',
          'msg' => 'Successful operation.',
          'code' => 200,
          'recordset' =>
          array (
            0 =>
            array (
              'Id' => '0903e241-677d-51b3-8643-291d93b0d40a',
              'ApplicantId' => NULL,
              'FirstName' => 'Jeniffer',
              'LastName' => 'Orantes',
              'Phone1' => '502-501-9459',
              'Phone2' => '',
              'Fax' => '',
              'Email1' => 'jenifferok@gmail.com',
              'Email2' => '',
              'Street1' => '23 Av. A 30-34 Zona 17',
              'Street2' => '',
              'City' => 'Guatemala',
              'StateId' => 0,
              'NameState' => 'NA',
              'Zip' => '01017',
              'CompanyId' => '072dae37-e419-4cce-9ec7-27070637df21',
              'CompanyName' => 'Long-Kogen Inc.',
            ),
          ),
        );

        $response = new JsonResponse($recordSet);

        if($pretty == 'true'){
            $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
        }

        return $response;
    }
}
