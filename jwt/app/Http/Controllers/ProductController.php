<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function getAllProduct()
    {
        try {
            $data = Product::get();
            return sendSuccessResponse($data);
        } catch (QueryException $e) {
            return sendErrorResponse("Something Went Wrong!", $e->getMessage(), 500);
        }
    }
    public function store($data = [])
    {
        try {
            Product::create($data);
            return sendSuccessResponse([], 'Data Created Successfully!', 201);
        } catch (QueryException $e) {
            return sendErrorResponse("Something Went Wrong!", $e->getMessage(), 500);
        }
    }
    public function show($id)
    {
        try {
            $data = Product::find($id);
            if ($data) {
                return sendSuccessResponse($data);
            } else {
                return sendErrorResponse([], 'Data Not found!', 404);
            }
        } catch (QueryException $e) {
            return sendErrorResponse("Something Went Wrong!", $e->getMessage(), 500);
        }
    }
    public function update($data = [], $id)
    {
        try {
            $data = Product::find($id)->update($data);
            return sendSuccessResponse($data, 'Data Updated Successfully!');
        } catch (QueryException $e) {
            return sendErrorResponse("Something Went Wrong!", $e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $product =  Product::find($id);
            if ($product) {
                $product->delete();
                return sendSuccessResponse([], 'Data Deleted Successfully!', 200);
            }
        } catch (QueryException $e) {
            return sendErrorResponse("Something Went Wrong!", $e->getMessage(), 500);
        }
    }
    public function getDataWithPagination()
    {
        Product::latest()->paginate(5);
    }
}
