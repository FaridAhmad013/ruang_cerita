<div>
    @php
        $nama_bpr = @strtoupper($data->_bpr->perusahaan->name.' '. @$data->_bpr->jenis_bank.' '.@$data->_bpr->name);
    @endphp
  @isset($data)
    <div class="row mb-3">
      <div class="col-md-4">BPR</div>
      <div class="col-md-8 font-weight-bold">: {{ @($nama_bpr) }} </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4">Nomor Transaksi</div>
      <div class="col-md-8 font-weight-bold">: {{ @$data->nomor_transaksi }} </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4">Tahun Laporan</div>
      <div class="col-md-8 font-weight-bold">: {{ @$data->tahun }} </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4">Nama PIC</div>
      <div class="col-md-8 font-weight-bold">: {{ $data->nama_pic }}</div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4">Jabatan PIC</div>
      <div class="col-md-8 font-weight-bold">: {{ @$data->jabatan_pic }}</div>
    </div>
    <hr>
    <div class="row mb-3">
      <div class="col-md-12 font-weight-bold mb-3">File Lampiran</div>
      <div class="col-md-12">
        <div class="row">
          @if (isset($data->t_detail_dokumen_smki) && count($data->t_detail_dokumen_smki) > 0)
            @foreach ($data->t_detail_dokumen_smki as $detail)
              <div class="col-md-6" style="min-height: 600px">
                <div class="border bg-secondary my-3 position-relative">
                  <div class="p-1">
                    <p class="text-center font-weight-bold">{{ @$detail->nama_dokumen_kelengkapan }}</p>
                    <object
                      data="{{ route('kelola_dokumen.get_file_next_cloud', ['path' => "BPR_".str_replace(' ', '-', $nama_bpr.'_'.str_replace('/', '-', $data->nomor_transaksi)), 'filename' => $detail->filename]) }}"
                      {{-- data="{{ asset('pdf/dokumen_kebijakan_keamanan_informasi-24022024083716267.pdf') }}" --}}
                      width="100%"
                      height="600px"
                      type="application/pdf"
                      class="pdf-object"
                      id="pdf-object-{{ $loop->index }}"
                    >
                        <div id="wrap_fail_render_pdf_{{ $loop->index }}" style="width: 100%;">
                          <div class="d-flex align-items-center justify-content-center" style="min-height: 600px; width: 100%;">
                            <div>
                              <h2>Gagal Memuat PDF</h2>
                              <div class="my-3 text-center">
                                <button class="btn btn-secondary" type="button" onclick="refresh_pdf(this)" data-wrap_id="wrap_fail_render_pdf_{{ $loop->index }}" data-parent_id="pdf-object-{{ $loop->index }}"><i class="fas fa-sync-alt"></i> Coba Lagi</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </object>
                  </div>
                  <hr>
                  <div class="px-3">
                    <div class="form-group">
                      <label for="alasan_ditolak_{{ $loop->index }}">Alasan ditolak</label>
                      <textarea name="reject_desc[{{ $detail->id }}]" id="alasan_ditolak_{{ $loop->index }}" data-id="{{ $loop->index }}" data-label="{{ @$detail->nama_dokumen_kelengkapan }}" class="form-control alasan-ditolak" @if(isset($type) && $type == 'view') disabled @endif>{{ @$detail->reject_desc }}</textarea>
                      <i class="text-danger validation-message text-sm" id="validation_reject_desc_{{ $loop->index }}"></i>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="col-md-12">
              <div class="alert alert-info"><i class="fas fa-info-circle"></i> Tidak ada file yang dilampirkan</div>
            </div>
          @endif
        </div>
      </div>
    </div>
  @endisset
</div>

