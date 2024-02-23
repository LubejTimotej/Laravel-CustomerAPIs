<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stranka;
use Illuminate\Support\Facades\Log;

class StrankaController3 extends Controller
{
    protected $tableStrankas = 'strankas_third';

    private function createStrankaInstance()
    {
        $stranka = new Stranka;
        $stranka->setTable($this->tableStrankas);
        return $stranka;
    }

    // 3. API
    public function getApi3($id)
    {
        try {
            $stranka = $this->createStrankaInstance();
            $stranka = $stranka->find($id);

            if (!$stranka) {
                return response()->json(['error' => 'Record not found'], 404);
            }

            return response()->json(['data' => $stranka], 200);
        } catch (\Exception $e) {
            Log::error('Error in getApi3: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile());
            Log::error('Line: ' . $e->getLine());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function insertApi3(Request $request)
    {
        try {
            Log::info('API Insert Request:', ['request' => $request->all()]);
            $data = $request->all();
            $stranka = $this->createStrankaInstance();
            $stranka->create($data);

            return response()->json(['message' => 'User has been added to the table'], 200);
        } catch (\Exception $e) {
            Log::error('Error in insertApi3: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile());
            Log::error('Line: ' . $e->getLine());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function updateApi3($id, Request $request)
    {
        try {
            $stranka = $this->createStrankaInstance();
            $stranka = $stranka->find($id);

            if (!$stranka) {
                return response()->json(['error' => 'Record not found'], 404);
            }

            $data = $request->all();
            $stranka->update($data);

            return response()->json(['message' => 'User has been updated'], 200);
        } catch (\Exception $e) {
            Log::error('Error in updateApi3: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile());
            Log::error('Line: ' . $e->getLine());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function deleteApi3($id, Request $request)
    {
        try {
            $stranka = $this->createStrankaInstance();
            $stranka = $stranka->find($id);

            if (!$stranka) {
                return response()->json(['error' => 'Record not found'], 404);
            }

            $stranka->delete();

            return response()->json(['message' => 'User has been deleted successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th], 404);
        }
    }
}
