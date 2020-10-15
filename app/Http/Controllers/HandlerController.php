<?php

namespace App\Http\Controllers;

use App\Models\BaseRegion;
use App\Modules\connector\OracleConnector;
use App\Modules\db\OracleDB;
use App\Modules\query\QueryOracle;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HandlerController extends Controller
{
    /**
     * @param int $bdId
     * @param string $division
     * @param string $date
     * @return mixed
     */
    public function gp(int $bdId, string $division, string $date)
    {
        $validator = Validator::make([
            'date'     => $date,
            'dbId'     => $bdId,
            'division' => $division
        ], [
            'date'     => 'required|date',
            'dbId'     => 'required|numeric',
            'division' => 'required'
        ], [
            'date.required' => 'Не выбрана дата.',
            'date.date'     => 'Не верный формат даты.',
            'dbId.required' => 'Не выбрана база.',
            'dbId.numeric'  => 'Не числовое значение.',
            'division.required' => 'Не выбрано подразделение.'
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => false, 'message' => $validator->errors()->all()]);
        }

        $baseRegion = BaseRegion::find($bdId);
        $dateTime = date_create_from_format('Y-m-d h:i:s', date('Y-m-d h:i:s', strtotime($date)));

        ini_set('memory_limit', '14024m');

        $OrConnector = new OracleConnector(
            $baseRegion->tns->service_name,
            $baseRegion->tns->host, $baseRegion->tns->port,
            $baseRegion->tns->sid, $baseRegion->tns->db,
            $baseRegion->tns->user, $baseRegion->tns->password
        );

        $mount = $dateTime->format('m');
        $year = $dateTime->format('Y');

        $dbOracle = OracleDB::initOnConnector($OrConnector);
        $queryGP= QueryOracle::qu1($division, $mount, $year);
        $arrayGP = $dbOracle->select($queryGP);
        if ($dbOracle->isError()) {
            return response()->json(['success'=>false, 'message'=>$dbOracle->errorMessage()]);
        }

        return response()->json([
            'arrayGP' => $arrayGP,
            'success' => true
        ]);
    }

    public function osb(int $bdId, string $division, string $date) {
        $validator = Validator::make([
            'date'     => $date,
            'dbId'     => $bdId,
            'division' => $division
        ], [
            'date'     => 'required|date',
            'dbId'     => 'required|numeric',
            'division' => 'required'
        ], [
            'date.required' => 'Не выбрана дата.',
            'date.date'     => 'Не верный формат даты.',
            'dbId.required' => 'Не выбрана база.',
            'dbId.numeric'  => 'Не числовое значение.',
            'division.required' => 'Не выбрано подразделение.'
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => false, 'message' => $validator->errors()->all()]);
        }

        $baseRegion = BaseRegion::find($bdId);
        $dateTime = date_create_from_format('Y-m-d h:i:s', date('Y-m-d h:i:s', strtotime($date)));

        ini_set('memory_limit', '14024m');

        $OrConnector = new OracleConnector(
            $baseRegion->tns->service_name,
            $baseRegion->tns->host, $baseRegion->tns->port,
            $baseRegion->tns->sid, $baseRegion->tns->db,
            $baseRegion->tns->user, $baseRegion->tns->password
        );

        $mount = $dateTime->format('m');
        $year = $dateTime->format('Y');

        $dbOracle = OracleDB::initOnConnector($OrConnector);
        $queryOSB = QueryOracle::qu2($division, $mount, $year);
        $arrayOSB = $dbOracle->select($queryOSB);

        if ($dbOracle->isError()) {
            return response()->json(['success'=>false, 'message'=>$dbOracle->errorMessage()]);
        }

        return response()->json([
            'arrayOSB' => $arrayOSB,
            'success'  => true
        ]);
    }

    public function peny(int $bdId, string $division, string $date) {
        $validator = Validator::make([
            'date'     => $date,
            'dbId'     => $bdId,
            'division' => $division
        ], [
            'date'     => 'required|date',
            'dbId'     => 'required|numeric',
            'division' => 'required'
        ], [
            'date.required' => 'Не выбрана дата.',
            'date.date'     => 'Не верный формат даты.',
            'dbId.required' => 'Не выбрана база.',
            'dbId.numeric'  => 'Не числовое значение.',
            'division.required' => 'Не выбрано подразделение.'
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => false, 'message' => $validator->errors()->all()]);
        }

        $baseRegion = BaseRegion::find($bdId);
        $dateTime = date_create_from_format('Y-m-d h:i:s', date('Y-m-d h:i:s', strtotime($date)));

        ini_set('memory_limit', '14024m');

        $OrConnector = new OracleConnector(
            $baseRegion->tns->service_name,
            $baseRegion->tns->host, $baseRegion->tns->port,
            $baseRegion->tns->sid, $baseRegion->tns->db,
            $baseRegion->tns->user, $baseRegion->tns->password
        );

        $mount = $dateTime->format('m');
        $year = $dateTime->format('Y');

        $dbOracle = OracleDB::initOnConnector($OrConnector);
        $queryPeny = QueryOracle::qu3($division, $mount, $year);
        $arrayPeny = $dbOracle->select($queryPeny);

        if ($dbOracle->isError()) {
            return response()->json(['success'=>false, 'message'=>$dbOracle->errorMessage()]);
        }

        return response()->json([
            'arrayPeny' => $arrayPeny,
            'success'  => true
        ]);
    }

    public function shtraf(int $bdId, string $division, string $date) {
        $validator = Validator::make([
            'date'     => $date,
            'dbId'     => $bdId,
            'division' => $division
        ], [
            'date'     => 'required|date',
            'dbId'     => 'required|numeric',
            'division' => 'required'
        ], [
            'date.required' => 'Не выбрана дата.',
            'date.date'     => 'Не верный формат даты.',
            'dbId.required' => 'Не выбрана база.',
            'dbId.numeric'  => 'Не числовое значение.',
            'division.required' => 'Не выбрано подразделение.'
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => false, 'message' => $validator->errors()->all()]);
        }

        $baseRegion = BaseRegion::find($bdId);
        $dateTime = date_create_from_format('Y-m-d h:i:s', date('Y-m-d h:i:s', strtotime($date)));

        ini_set('memory_limit', '14024m');

        $OrConnector = new OracleConnector(
            $baseRegion->tns->service_name,
            $baseRegion->tns->host, $baseRegion->tns->port,
            $baseRegion->tns->sid, $baseRegion->tns->db,
            $baseRegion->tns->user, $baseRegion->tns->password
        );

        $mount = $dateTime->format('m');
        $year = $dateTime->format('Y');

        $dbOracle = OracleDB::initOnConnector($OrConnector);
        $queryShtraf = QueryOracle::qu4($division, $mount, $year);
//        dd($queryShtraf);
        $arrayShtraf = $dbOracle->select($queryShtraf);

        if ($dbOracle->isError()) {
            return response()->json(['success'=>false, 'message'=>$dbOracle->errorMessage()]);
        }

        return response()->json([
            'arrayShtraf' => $arrayShtraf,
            'success'  => true
        ]);
    }

    public function countError(int $bdId, string $division, string $date) {
        $validator = Validator::make([
            'date'     => $date,
            'dbId'     => $bdId,
            'division' => $division
        ], [
            'date'     => 'required|date',
            'dbId'     => 'required|numeric',
            'division' => 'required'
        ], [
            'date.required' => 'Не выбрана дата.',
            'date.date'     => 'Не верный формат даты.',
            'dbId.required' => 'Не выбрана база.',
            'dbId.numeric'  => 'Не числовое значение.',
            'division.required' => 'Не выбрано подразделение.'
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => false, 'message' => $validator->errors()->all()]);
        }

        $baseRegion = BaseRegion::find($bdId);
//        $dateTime = date_create_from_format('Y-m-d h:i:s', date('Y-m-d h:i:s', strtotime($date)));

        ini_set('memory_limit', '14024m');

        $OrConnector = new OracleConnector(
            $baseRegion->tns->service_name,
            $baseRegion->tns->host, $baseRegion->tns->port,
            $baseRegion->tns->sid, $baseRegion->tns->db,
            $baseRegion->tns->user, $baseRegion->tns->password
        );

//        $mount = $dateTime->format('m');
//        $year = $dateTime->format('Y');

        $dbOracle = OracleDB::initOnConnector($OrConnector);
        $queryCountError = QueryOracle::qu5();
        $arrayCountError = $dbOracle->select($queryCountError);

        if ($dbOracle->isError()) {
            return response()->json(['success'=>false, 'message'=>$dbOracle->errorMessage()]);
        }

        return response()->json([
            'arrayCountError' => $arrayCountError,
            'success'  => true
        ]);
    }
}
