@extends('admin.pages.home')

@section('title', 'Tambah Penilaian Sidang')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    Tambah Penilaian Sidang
                </div>
                <div class="card-body">
                    <form action="{{ route('penilaian_sidang.store') }}" method="POST">
                        @csrf

                        <!-- Mahasiswa PKL Selection -->
                        <div class="mb-3">
                            <label for="id_mahasiswa_pkl" class="form-label">Mahasiswa PKL</label>
                            <select class="form-control" name="id_mahasiswa_pkl" required>
                                @foreach($mahasiswaPkl as $mahasiswa)
                                    <option value="{{ $mahasiswa->id_mahasiswa_pkl }}">{{ $mahasiswa->mahasiswa->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Dosen Selection -->
                        <div class="mb-3">
                            <label for="id_dosen" class="form-label">Dosen</label>
                            <select class="form-control" name="id_dosen" required>
                                @foreach($dosen as $dsn)
                                    <option value="{{ $dsn->id_dosen }}">{{ $dsn->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Posisi Selection -->
                        <div class="mb-3">
                            <label for="posisi" class="form-label">Posisi</label>
                            <select class="form-control" name="posisi" id="posisi">
                                <option value="dosen pembimbing">Dosen Pembimbing</option>
                                <option value="dosen penguji">Dosen Penguji</option>
                            </select>
                        </div>

                        <!-- Penilaian Aspects -->
                        <div class="form-group">
                            <label for="bahasa">Bahasa</label>
                            <input type="number" name="bahasa" id="bahasa" class="form-control" min="1" max="100" required oninput="calculateTotal()">
                        </div>

                        <div class="form-group">
                            <label for="analisis">Analisis</label>
                            <input type="number" name="analisis" id="analisis" class="form-control" min="1" max="100" required oninput="calculateTotal()">
                        </div>

                        <div class="form-group">
                            <label for="sikap">Sikap</label>
                            <input type="number" name="sikap" id="sikap" class="form-control" min="1" max="100" required oninput="calculateTotal()">
                        </div>

                        <div class="form-group">
                            <label for="komunikasi">Komunikasi</label>
                            <input type="number" name="komunikasi" id="komunikasi" class="form-control" min="1" max="100" required oninput="calculateTotal()">
                        </div>

                        <div class="form-group">
                            <label for="penyajian">Penyajian</label>
                            <input type="number" name="penyajian" id="penyajian" class="form-control" min="1" max="100" required oninput="calculateTotal()">
                        </div>

                        <div class="form-group">
                            <label for="penguasaan">Penguasaan</label>
                            <input type="number" name="penguasaan" id="penguasaan" class="form-control" min="1" max="100" required oninput="calculateTotal()">
                        </div>

                        <!-- Total Nilai -->
                        <div class="form-group">
                            <label for="total_nilai">Total Nilai</label>
                            <input type="text" name="total_nilai" id="total_nilai" class="form-control" readonly>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                    <script>
                        // Function to calculate total score based on percentage weights for each aspect
                        function calculateTotal() {
                            // Bobot persentase untuk setiap aspek penilaian (misalnya, 15%, 20%, 10%, dll)
                            const bobotBahasa = 0.15; // 15% untuk Bahasa
                            const bobotAnalisis = 0.15; // 15% untuk Analisis
                            const bobotSikap = 0.15; // 15% untuk Sikap
                            const bobotKomunikasi = 0.15; // 15% untuk Komunikasi
                            const bobotPenyajian = 0.15; // 20% untuk Penyajian
                            const bobotPenguasaan = 0.25; // 20% untuk Penguasaan

                            // Mengambil nilai dari inputan
                            const bahasa = parseInt(document.getElementById('bahasa').value) || 0;
                            const analisis = parseInt(document.getElementById('analisis').value) || 0;
                            const sikap = parseInt(document.getElementById('sikap').value) || 0;
                            const komunikasi = parseInt(document.getElementById('komunikasi').value) || 0;
                            const penyajian = parseInt(document.getElementById('penyajian').value) || 0;
                            const penguasaan = parseInt(document.getElementById('penguasaan').value) || 0;

                            // Menghitung total nilai berdasarkan bobot persentase untuk setiap aspek
                            const totalNilai = (bahasa * bobotBahasa) +
                                               (analisis * bobotAnalisis) +
                                               (sikap * bobotSikap) +
                                               (komunikasi * bobotKomunikasi) +
                                               (penyajian * bobotPenyajian) +
                                               (penguasaan * bobotPenguasaan);

                            // Update field total_nilai dengan hasil perhitungan
                            document.getElementById('total_nilai').value = totalNilai.toFixed(2); // Format sebagai angka dengan dua desimal
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
