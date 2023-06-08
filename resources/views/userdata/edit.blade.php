@extends('layouts.app')

@section('content')
    <div class="card m-3">
        <div class="card-body">
            <h4 class="card-title">Alamat dan Nomor Telephone</h4>
            <p class="card-text">alamt dibutuhkan agar pengiriman dapat dilakukan</p>
            <form action="{{ route('userData.update') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{old('address', auth()->user()->address ?? '')}}">
                    <small id="helpId" class="form-text text-muted">untuk mengetahui lokasi</small>
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="telephone_number" class="form-label">Telephone Number</label>
                    <input type="number" class="form-control @error('telephone_number') is-invalid @enderror" name="telephone_number" id="telephone_number" value="{{old('telephone_number', auth()->user()->telephone_number ?? '')}}">
                    <small id="helpId" class="form-text text-muted">untuk mengontak anda</small>
                    @error('telephone_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="mt-3 btn btn-success">
                    <i class="bi bi-download"></i> Simpan
                </button>
            </form>
        </div>
    </div>
@endsection
