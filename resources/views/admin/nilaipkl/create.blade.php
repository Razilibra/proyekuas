@extends('admin.pages.home')

@section('title', 'Tambah Penilaian PKL')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Penilaian PKL</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('nilaipkl.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_dosen">Dosen</label>
                            <select name="id_dosen" class="form-control">
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id_dosen }}">{{ $dosen->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_mahasiswa_pkl">Mahasiswa PKL</label>
                            <select name="id_mahasiswa_pkl" class="form-control">
                                @foreach ($mahasiswa_pkl as $mahasiswaPkl)
                                    <option value="{{ $mahasiswaPkl->id_mahasiswa_pkl }}">{{ $mahasiswaPkl->mahasiswa->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="keaktifan_bimbingan">Keaktifan Bimbingan</label>
                            <input type="number" name="keaktifan_bimbingan" class="form-control" min="0" max="100" id="keaktifan_bimbingan">
                        </div>
                        <div class="form-group">
                            <label for="komunikatif">Komunikatif</label>
                            <input type="number" name="komunikatif" class="form-control" min="0" max="100" id="komunikatif">
                        </div>
                        <div class="form-group">
                            <label for="problem_solving">Problem Solving</label>
                            <input type="number" name="problem_solving" class="form-control" min="0" max="100" id="problem_solving">
                        </div>
                        <div class="form-group">
                            <label for="total_nilai">Total Nilai</label>
                            <input type="number" name="total_nilai" class="form-control" id="total_nilai" readonly>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('nilaipkl.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to calculate total score based on percentage weights for each aspect
    function calculateTotal() {
        // Bobot persentase untuk setiap aspek penilaian
        const bobotKeaktifan = 0.30; // 30% untuk Keaktifan Bimbingan
        const bobotKomunikatif = 0.30; // 30% untuk Komunikatif
        const bobotProblemSolving = 0.40; // 40% untuk Problem Solving

        // Mengambil nilai dari inputan
        const keaktifan = parseInt(document.getElementById('keaktifan_bimbingan').value) || 0;
        const komunikatif = parseInt(document.getElementById('komunikatif').value) || 0;
        const problemSolving = parseInt(document.getElementById('problem_solving').value) || 0;

        // Menghitung total nilai berdasarkan bobot persentase untuk setiap aspek
        const totalNilai = (keaktifan * bobotKeaktifan) +
                           (komunikatif * bobotKomunikatif) +
                           (problemSolving * bobotProblemSolving);

        // Update field total_nilai dengan hasil perhitungan
        document.getElementById('total_nilai').value = totalNilai.toFixed(2); // Format sebagai angka dengan dua desimal
    }

    // Attach event listeners to input fields to trigger total calculation
    document.getElementById('keaktifan_bimbingan').addEventListener('input', calculateTotal);
    document.getElementById('komunikatif').addEventListener('input', calculateTotal);
    document.getElementById('problem_solving').addEventListener('input', calculateTotal);
</script>

@endsection
