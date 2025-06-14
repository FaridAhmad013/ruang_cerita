<div class="form-group">
  <label for="username">Pertanyaan</label>
  <textarea name="pertanyaan" id="pertanyaan" class="form-control">{{ @$data->pertanyaan }}</textarea>
</div>


<div class="form-group">
  <label for="select2-kategori_pertanyaan">Kategori Pertanyaan</label>
  <select name="kategori_pertanyaan_id" id="select2-kategori_pertanyaan" class="form-control">
    @isset($data)
      <option value="{{ $data->kategori_pertanyaan->id }}">{{ $data->kategori_pertanyaan->kategori }}</option>
    @endisset
  </select>
</div>

<script>
  $(`#select2-kategori_pertanyaan`).select2({
    ajax: {
      url: _url_select2.kategori_pertanyaan,
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          term: params.term,
          page: params.page || 0,
          limit: _limit
        };
      },
      processResults: function (data, params) {
        params.page = params.page || 0;
        let check = params.page+1;
        return {
          results: data.items,
          pagination: {
            more: (data.total - (check * _limit)) > 0
          }
        };
      },
      cache: true
    },
    templateResult: (res) => {
      if (res.loading) {
        return res.text;
      }
      return res.kategori
    },
    templateSelection: (res) => {
      return res.kategori ? res.kategori : res.text
    },
    placeholder: "Pilih Salah Satu"
  })
</script>
