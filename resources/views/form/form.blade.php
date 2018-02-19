@extends("admin.base.base")
@section('title')
    مدیریت نظرات
@endsection
@section('css')
    <script src="{{asset('dist/js/pagination.js')}}" type="text/javascript"></script>
@endsection
@section('header')
    مدیریت نظرات
@endsection

@if(session()->has('flash_message'))
    {{session()->get('flash_message')}}
@endif

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <a href="/admin/news/new">
                        <input type="button" class="btn btn-primary pull-right" value="افزودن خبر">
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">مدیریت محتوی نظرات</h4>
                    <p class="category">لیست نظر های موجود در سایت</p>
                </div>
                <div class="card-content">
                    <div class="col-md-10 col-md-offset-1 col-xs-12">


                        {{--<div class="row">--}}

                        {{--<div class="colxs-12 col-md-2 pull-right">--}}
                        {{--<label>جستجو :</label>--}}
                        {{--</div>--}}

                        {{--<div class="col-xs-12 col-md-10 pull-right">--}}
                        {{--<form action="{{route('form.show.search')}}"  method="get" role="search">--}}
                        {{--<input type="text" name="search" value="" id="search" class="form-control" placeholder="search">--}}
                        {{--<button type="submit" class="btn btn-primary pull-right">search</button>--}}
                        {{--</form>--}}
                        {{--</div>--}}

                        {{--</div>--}}
                        {{--<div class="row">--}}


                        <div class="row">
                            <div class="colxs-12 col-md-2 pull-right">
                                <label>جستجو :</label>
                            </div>
                            <div class="col-xs-12 col-md-10 pull-right">
                                <input id="search" name="search" class="form-control" placeholder="جستجو">
                            </div>
                            <div class="col-xs-12 col-md-10 pull-right">
                                <input type="button" onclick="search()" value="اعمال" class="btn btn-primary">
                            </div>
                        </div>


                        <div class="col-xs-12">
                            @if($forms == false)
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 pull-right">
                                        <div class="alert alert-info alert-with-icon" data-notify="container">
                                            <i data-notify="icon" class="flaticon-info-sign"></i>
                                            <span data-notify="message">هیچ خبری یافت نشد. لطفا خبر جدیدی وارد کنید.</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table id="" class="table">
                                        <thead class="text-primary">
                                        <tr>
                                            <th class="col-xs-1 text-right">ردیف</th>
                                            <th class="col-xs-5 text-right">عنوان نظر</th>
                                            <th class="col-xs-4 text-right">تاریخ ثبت نظر</th>
                                            <th class="col-xs-2 text-right">عملیات</th>
                                        </tr>
                                        </thead>


                                        <tbody data-content="content_table">
                                        @foreach($forms as $one_news)
                                            <tr data-status="">

                                                <td data-id="{{$one_news->id}}" class="">{{$one_news->id}}</td>
                                                <td class="">{{$one_news->text}}</td>
                                                <td class="">{{$one_news->created_at}}</td>

                                                <td class="actional">
                                                    <form action="{{route('form.delete', $one_news->id)}}"
                                                          method="post">
                                                        {{ method_field('DELETE')}}
                                                        {{csrf_field()}}
                                                        <button>
                                                                <span data-id="{{$one_news->id}}"
                                                                      data-title="delete_news"
                                                                      class="flaticon-trash-2 delete_news_button "
                                                                      data-toggle="tooltip" title="حذف"></span>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>


                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <div class="card-content">
                                            <ul class="pagination"></ul>

                                        </div>

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="_alert_">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                class="fa fa-times-circle"></i>&nbsp;
                    </button>
                    <h4 class="modal-title">پیغام</h4>
                </div>
                <div class="modal-body alert_modal_class">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <div id="not_valid_Guarantee" style="display: none" class="alert alert-danger"></div>
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="بستن">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')

    <script type="text/javascript">
        //        $('#search').on('keyup', function () {
        //
        //
        //        })
        function search() {
            $value = $('#search').val();
            $.ajax({
                type: 'get',
                url: '{{\Illuminate\Support\Facades\URL::to('/admin/form/search')}}',
                data: {'search': $value},
                success: function (data) {
                    if (data == "not") {
                        $('tbody').html("هیچ موردی یافت نشد");
                    } else {

                        $('tbody').html(data);
                    }
                },
                error: function (data) {
                    alert("not found");
                }

            })
        }
    </script>
@endsection

