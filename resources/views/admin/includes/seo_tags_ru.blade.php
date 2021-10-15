@php
    if(isset($page)){
        $desc = old('meta_description_ru') ? old('meta_description_ru') : $page->meta_description_ru;
    }else {
        $desc =  old('meta_description_ru');
    }

@endphp
<h5>Мета_теги <small>(необязательно для заполнения)</small></h5>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Meta_title</label>
            <input type="text" name="meta_title_ru" class="form-control"
                   @isset($page)
                   value="{{ old('meta_title_ru') ? old('meta_title_ru') : $page->meta_title_ru }}"
                   @else
                   value="{{ old('meta_title_ru') }}"
                    @endisset
            >
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>Meta_description</label>
            <textarea name="meta_description_ru" class="form-control" rows="4">{{ $desc or '' }}</textarea>
        </div>
    </div>
</div>