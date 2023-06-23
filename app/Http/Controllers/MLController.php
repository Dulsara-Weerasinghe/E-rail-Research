<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MLController extends Controller
{
    private $model;

    public function __construct()
    {
        // Load the model during the controller's initialization
        $modelPath = storage_path('G:\SLIIT\eRail_Production\eRail\2023-182\public\saved_models\Track_Predictor.pickle');
        $this->model = $this->loadPickleModel($modelPath);
    }

    public function predict(Request $request)
    {
        // Retrieve input data from the request
        // $inputData = $request->input('data');
        $inputData = [154.21,250.12,220,12,190.21,0.0,0.0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];


        // Preprocess input data if needed

        // Convert the input data to a numeric array
        // $inputArray = array_map('floatval', explode(',', $inputData));

        // Pass the data to the model for prediction
        $prediction = $this->predictWithModel($inputData);

        // Format and return the prediction as a response
        return response()->json(['prediction' => $prediction]);
    }

    private function loadPickleModel($modelPath)
    {
        $pythonCommand = "python -c 'import pickle; model = pickle.load(open(\"$modelPath\", \"rb\")); print(model)'";
        $output = trim(exec($pythonCommand));
        return unserialize($output);
    }

    // private function predictWithModel($inputData)
    // {
    //     $inputString = implode(',', $inputData);
    //     $pythonCommand = "python -c 'import pickle; model = $this->model; prediction = model.predict([$inputString]); print(prediction)'";
    //     $output = trim(exec($pythonCommand));
    //     return $output;
    // }

    private function predictWithModel($inputData)
    {
        $inputString = json_encode($inputData);
        $pythonCommand = "python -c 'import pickle; import json; model = $this->model; inputData = json.loads(\"$inputString\"); prediction = model.predict(inputData); print(prediction)'";
        $output = trim(exec($pythonCommand));
        return $output;
    }



    
}
