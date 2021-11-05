<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    function index()
    {
        $response = Student::all();
        $data = ["message" => "All Student", "data" => $response];
        return response()->json($response, 200);
    }

    function getById($id)
    {
        try {
            $student = Student::findOrFail($id);
            $data = ["message" => "find students with Id", "data" => $student];
            return response()->json($data, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "error", "info" => "No query results for model with id " . $id], 404);
        }
    }

    function create(Request $request)
    {
        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;
        $student = Student::create([
            "nama" => $nama,
            "nim" => $nim,
            "email" => $email,
            "jurusan" => $jurusan,
        ]);

        $data = [
            "message" => "student is created successfully",
            "data" => $student
        ];

        return response()->json($data, 200);
    }

    function update(Request $request, $id)
    {

        $nama = $request->nama;
        $nim = $request->nim;
        $email = $request->email;
        $jurusan = $request->jurusan;

        try {

            $student = Student::findOrFail($id);
            $student->nama = $nama;
            $student->nim = $nim;
            $student->email = $email;
            $student->jurusan = $jurusan;

            $student->save();

            $data = [
                "message" => "student is updated successfully",
                "data" => $student

              ]; 

              return response()->json($data, 200);


        } catch (ModelNotFoundException $e) {

          return response()->json(["message" => "error", "info" => "No query results for model with id " . $id], 404);

        } catch (Exception $e) {

          return response()->json(["message" => "error", "info" => $e->errorInfo[2]], 500);
        }

    }

    function destroy($id) {

        try {

          $student = Student::findOrFail($id);
          $student->delete();
          $data = [

            "message" => "student is deleted successfully",
            "data" => $student

          ];

          return response()->json($data, 200);
          
        } catch (ModelNotFoundException $e) {

          return response()->json(["message" => "error", "info" => "No query results for model with id " . $id], 404);

        } catch (Exception $e) {

          return response()->json(["message" => "error", "info" => $e->errorInfo[2]], 500);

        }   
    }
}
