@extends('layouts.admin')
@section('main')
<div class="box box-primary">
    <div class="box-body">
        <form id="formSearch" action="{{route('searchcategory')}}" method="get" data-container="#searchResult">
            <!-- Form nhập đầu vào tìm kiếm -->
            <div class="input-group">
                <input name="search" type="text" class="form-control" placeholder="Nhập tên loại hàng cần tìm" autofocus>
                <div class="input-group-btn">
                    <button class="btn btn-info" type="submit" style="padding: 9px 12px;">
                        <i class=" glyphicon glyphicon-search"></i>
                    </button>

                    <a href="{{route('addcategory')}}" class="btn btn-primary" style="margin-left: 5px">
                        <i class="fa fa-plus"></i> Bổ sung
                    </a>
                </div>
            </div>
        </form>

        <!-- Hiển thị kết quả tìm kiếm -->
        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa-solid fa-xmark"></i>
            </button>
            {{session()-> get('message')}}
        </div>
        @endif
        <div id="searchResult">
            <!-- <p style="margin: 10px 0 10px 0">
                Có <strong>@Model.RowCount</strong> khách hàng trong tổng số <strong>@Model.PageCount</strong> trang
            </p> -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead class="bg-primary">
                        <tr>
                            <th class=" text-center">Tên loại hàng</th>
                            <th class=" text-center">Loại hàng cha</th>
                            <th class=" text-center">Mô tả</th>
                            <th style="width:100px" class=" text-center">Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item->CategoryName }}</td>
                            @foreach($categorylist as $item1)
                            @if($item1->CategoryId == $item->ParentId)
                            <td class="form-control-static">{{$item1->CategoryName}}</td>
                            @else
                            <td></td>
                            @endif
                            @endforeach
                            <td>{{ $item->CategoryDescription }}</td>
                            <td class="text-center">
                                <a href="{{ route('editcategory', $item->CategoryId) }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('deletecategory', $item->CategoryId) }}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <ul class="pagination">
                </ul>
            </div>
        </div>
    </div>
</div>

<!--  -->
@stop();