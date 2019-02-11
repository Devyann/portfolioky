@extends('admin.layouts.app')
@section('page-title')
    <p>En-têtes</p>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-info">
                    <i class="fas fa-plus-square"></i> Formulaire de création d'en-têtes
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('headers.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="headMainTitle">Titre</label>
                                <input type="text" name="site_title" class="form-control" id="headMainTitle" placeholder="Titre Principal">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="headerSubTitle">Sous-titre</label>
                                <input type="text" name="site_subtitle" class="form-control" id="headerSubTitle" placeholder="Sous-titre">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pageParent">Page parent</label>
                                <select id="pageParent" class="form-control" name="page_id">
                                    <option selected>Choisir...</option>
                                    @foreach($pages as $page)
                                        <option value="{{ $page->id }}">{{ $page->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bgImg">Background-image</label>
                                <select id="bgImg" class="form-control" name="bg_url">
                                    <option selected>Choisir...</option>
                                    @foreach( $images as $img )
                                        <option value="{{ $img->id }}" data-imgurl="{{ asset($img->thumbpath) }}">{{ $img->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <img id="preview" class="img-fluid" src="#" alt="">
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-script')
<script>
    $(() => {
            $(document).on("change","select",function(){
                $("option[value=" + this.value + "]", this)
                .attr("selected", true).siblings()
                .removeAttr("selected")
            });
            $('#bgImg').on('change', (e) => {
                let that = e.currentTarget;
                console.log(that.value);
                console.log($('#bgImg option:selected').attr('data-imgurl'));
                let imgUrl = $('#bgImg option:selected').attr('data-imgurl');
                $('#preview').attr('src', imgUrl);
                console.log($('#preview').attr('src'));
            });
        }); 
</script>
@endsection