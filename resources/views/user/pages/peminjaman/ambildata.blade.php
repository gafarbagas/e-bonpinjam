<div class="form-group row mt-3">
    <label for="nama_jaksa"  class="col-sm-2 col-form-label">Nama Jaksa</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="nama_jaksa" id="nama_jaksa" placeholder="Nama Jaksa" value="{{$ambildata->jaksa->nama_jaksa}}" readonly>
    </div>
</div>

<input type="hidden" class="form-control" name="terdakwa_id" placeholder="Nama Jaksa" value="{{$ambildata->id}}">

<div class="form-group row">
    <label for="barangbukti"  class="col-sm-2 col-form-label">Barang Bukti</label>
    <div class="col-sm-10">

        <div class="form-group row">
            <div class="col-sm-10">
                @foreach ($bb as $barangbukti)
                <div class="form-check">
                    <input class="form-check-input barang_bukti_id" type="checkbox" name="barang_bukti_id[]" id="{{ $barangbukti->nama_barangbukti }}" value="{{ $barangbukti->id }}">
                    <label class="form-check-label" for="{{ $barangbukti->nama_barangbukti }}">
                        {{ $barangbukti->nama_barangbukti }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

