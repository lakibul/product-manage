@extends('master.admin')
@section('content')
    <style>
        .button-center{
            display: flex;
            justify-content: center;
        }

        .button-right{
            display: flex;
            justify-content: end;
        }

        .professional-button {
            position: relative;
            padding: 10px 35px;
            justify-content: center!important;
            color: white;
            margin-bottom: 10px;
            background: #2a3042;
            border: 1px solid #23445D;
            border-radius: 5px;
        }

        .professional-button input {
            position: absolute;
            top: 0;
            left: 0;
            visibility: visible;
            opacity: 0;
        }
    </style>


    <section>
        <div class="container">
            <form action="{{route('image.save')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row button-center">
                    <div class="card-header">
                        <h2>Insert Image</h2>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 button-center">
                            <button type="button" class="professional-button">Upload
                                <input type="file" class="form-control-file" name="images[]" id="imgNamePreview" multiple/>
                            </button>
                        </div>
                        <div class="col-md-12 button-center" id="imgUpPreview">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 button-right">
                        <div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>



    <script>
        imgNamePreview.onchange = evt => {
            let file_array = [];
            let imgName = [];
            file_array = imgNamePreview.files
            for (const item of file_array) {
                console.log(item.name);
                imgName.push(item.name);
            }

            let preview = document.getElementById('imgUpPreview');
            preview.innerText = imgName;
            for (const item of file_array) {
                preview.innerText = imgName;
            }
            console.log(imgName);
        }
    </script>
@endsection
