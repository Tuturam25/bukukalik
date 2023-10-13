<?php 

include 'konek.php';

if(isset($_POST['tambah'])) {
    $penerbit = $_POST['penerbit'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $telepon = $_POST['telepon'];
    mysqli_query($conn, "insert into penerbit values('', '$penerbit', '$alamat', '$kota', '$telepon')");
    header('refresh: 0');
}
if(isset($_POST['tambahh']) and $_POST['penerbit'] != '') {
    $kategori = $_POST['kategori'];
    $namabuku = $_POST['namabuku'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $penerbit = $_POST['penerbit'];
    mysqli_query($conn, "insert into buku values('', '$kategori', '$namabuku', '$harga', '$stok', '$penerbit')");
    header('refresh: 0');
}
else if (isset($_POST['penerbit']) and $_POST['penerbit'] == '') {
    echo 'anda belum memilih penerbit';
    header('refresh: 3');
}

if(isset($_GET['home'])) {
    header('location: index.php');
}

if(isset($_POST['batal'])) {
    header('refresh: 0');
}

if(isset($_POST['konfirmasi'])) {
    $kategori = $_POST['kategori'];
    $namabuku = $_POST['namabuku'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $penerbit = $_POST['penerbit'];
    $gambar = $_FILES['gambar']['tmp_name'];
    $gambars = $_FILES['gambar']['name'];
    $id_buku = $_POST['id_buku'];
    mysqli_query($conn, "update buku set kategori = '$kategori', namabuku = '$namabuku', harga = '$harga', stok = '$stok', penerbit = '$penerbit', gambar = '$gambars' where id_buku = '$id_buku'");
    move_uploaded_file($gambar, "upload/$gambars");
    header('refresh: 0');
}
if(isset($_POST['konfirmasii'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $telepon = $_POST['telepon'];
    $id_penerbit = $_POST['id_penerbit'];
    mysqli_query($conn, "update penerbit set nama = '$nama', alamat = '$alamat', kota = '$kota', telepon = '$telepon' where id_penerbit = '$id_penerbit'");
    header('refresh: 0');
}

?>

<link rel="stylesheet" href="output.css">

<div class="bg-sky-800 flex gap-10 justify-between items-center text-white capitalize text-lg px-5">
    <span class="p-5 font-mono text-3xl">BukuKalik</span>
    <div class="flex p-5 gap-5">
    <a href="index.php">home</a>
    <a href="?admin">admin</a>
    <a href="?pengadaan">pengadaan</a>
    </div>
</div>


<?php if(!$_GET) : ?>


pemula


<?php endif ?>

<?php if(isset($_GET['admin'])) { ?>
    <div class="p-5">
        <table class="w-full capitalize text-center">
            <tr>
                <th>nama penerbit</th>
                <th class="border-x-2 border-b-2 p-3">alamat</th>
                <th class="border-x-2 border-b-2 p-3">kota</th>
                <th class="border-x-2 border-b-2 p-3">telepon</th>
                <th>aksi</th>
            </tr>
            <?php foreach(mysqli_query($conn, 'select * from penerbit') as $penerbit) { ?>
            <tr>
                <form action="" method="post">
                <td class="border-y-2 border-r-2 p-3">
                    <?php if(isset($_POST['ubah']) and $_POST['id'] == $penerbit['id_penerbit']) { ?>
                            <input type="hidden" name="id_penerbit" value="<?= $penerbit['id_penerbit'] ?>" >
                            <input type="text" name="nama" value="<?= $penerbit['nama'] ?>" class="border-2 text-center">
                    <?php } else { 
                        echo $penerbit['nama'];
                    }?>
                </td>
                <td class="border-y-2 border-r-2 p-3">
                    <?php if(isset($_POST['ubah']) and $_POST['id'] == $penerbit['id_penerbit']) { ?>
                        <input type="text" name="alamat" value="<?= $penerbit['alamat'] ?>" class="border-2 text-center">
                    <?php } else { 
                        echo $penerbit['alamat'];
                    }?>    
                </td>
                <td class="border-y-2 border-r-2 p-3">
                    <?php if(isset($_POST['ubah']) and $_POST['id'] == $penerbit['id_penerbit']) { ?>
                        <input type="text" name="kota" value="<?= $penerbit['kota'] ?>" class="border-2 text-center">
                    <?php } else { 
                        echo $penerbit['kota'];
                    }?>
                </td>
                <td class="border-y-2 border-r-2 p-3">
                    <?php if(isset($_POST['ubah']) and $_POST['id'] == $penerbit['id_penerbit']) { ?>
                        <input type="text" name="telepon" value="<?= $penerbit['telepon'] ?>" class="border-2 text-center">
                    <?php } else { 
                        echo $penerbit['telepon'];
                    }?>
                </td>
                <td class="border-y-2">    
                        <?php if(isset($_POST['ubah']) and $_POST['id'] == $penerbit['id_penerbit']) : ?>
                        <button name="konfirmasii" class="bg-sky-500 py-1 px-2 rounded-md capitalize text-white hover:bg-sky-600 transition-colors duration-300">konfirmasi</button>
                        <button name="batal" class="bg-red-800 py-1 px-2 rounded-md capitalize text-white hover:bg-sky-950 transition-colors duration-300">batal</button>
                            <?php else : ?>
                                <button name="ubah" class="bg-sky-800 py-1 px-2 rounded-md capitalize text-white hover:bg-sky-950 transition-colors duration-300">ubah</button>
                                <input type="hidden" name="id" value="<?= $penerbit['id_penerbit'] ?>">
                        <?php endif ?>
                    </form>
                </td>
                </tr>
            <?php } ?>
        </table>
    </div>

        <a href="#tambahadmin" class="rounded-full border-4 w-10 h-10 flex justify-center items-center p-10">&plus;</a>

    <div class="hidden target:block" id="tambahadmin">
        <a href="?admin" class="rounded-full border-4 w-5 h-5 flex justify-center items-center p-5">x</a>
        <form action="" method="post">
            <label for="">nama penerbit</label>
            <input type="text" name="penerbit">
            <label for="">alamat</label>
            <input type="text" name="alamat">
            <label for="">kota</label>
            <input type="text" name="kota">
            <label for="">telepon</label>
            <input type="number" name="telepon">
            <input type="submit" value="tambah" name="tambah">
        </form>
    </div>
<?php } ?>

<?php if(isset($_GET['pengadaan'])) { ?>
    <table class="w-full text-center">
        <tr>
            <th>kategori</th>
            <th>nama buku</th>
            <th>harga</th>
            <th>stok</th>
            <th>nama penerbit</th>
            <th>gambar</th>
            <th>aksi</th>
        </tr>
        <?php foreach(mysqli_query($conn, 'select * from buku join penerbit on buku.penerbit = penerbit.id_penerbit') as $buku) { ?>
        <tr>
            <form action="" method="post" enctype="multipart/form-data">
            <td>
                <?php if(isset($_POST['ubah']) and $_POST['id'] == $buku['id_buku']) { ?>
                        <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">
                        <input type="text" name="kategori" value="<?= $buku['kategori'] ?>">
                <?php } else { 
                    echo $buku['kategori'];
                }?>
            </td>
            <td>
                <?php if(isset($_POST['ubah']) and $_POST['id'] == $buku['id_buku']) { ?>
                    <input type="text" name="namabuku" value="<?= $buku['namabuku'] ?>">
                <?php } else { 
                    echo $buku['namabuku'];
                }?>    
            </td>
            <td>
                <?php if(isset($_POST['ubah']) and $_POST['id'] == $buku['id_buku']) { ?>
                    <input type="number" name="harga" value="<?= $buku['harga'] ?>">
                <?php } else { 
                    echo 'Rp. ' . number_format($buku['harga'],2,'.',',');
                }?>
            </td>
            <td>
                <?php if(isset($_POST['ubah']) and $_POST['id'] == $buku['id_buku']) { ?>
                    <input type="text" name="stok" value="<?= $buku['stok'] ?>">
                <?php } else { 
                    echo $buku['stok'];
                }?>
            </td>
            <td>
                <?php if(isset($_POST['ubah']) and $_POST['id'] == $buku['id_buku']) { ?>
                    <select name="penerbit" id="">
                    <option value="">pilih penerbit</option>
                    <?php foreach(mysqli_query($conn, "select * from penerbit") as $terbit) { ?>
                        <option <?php if($terbit['nama'] == $buku['nama']) echo 'selected' ?> value="<?= $terbit['id_penerbit'] ?>"><?= $terbit['nama'] ?></option>
                    <?php } ?>
                    </select>
                    <?php } else { 
                        echo $buku['nama'];
                    }?>
            </td>
            <td>
                <?php if(isset($_POST['ubah']) and $_POST['id'] == $buku['id_buku']) { ?>
                    <input type="file" name="gambar">
                <?php } else { ?>
                    <img src="upload/<?= $buku['gambar'] ?>" alt="" width="100">
                <?php }?>
            </td>
            <td>    
                    <?php if(!isset($_POST['ubah'])) : ?>
                    <button name="ubah">ubah</button>
                    <input type="hidden" name="id" value="<?= $buku['id_buku'] ?>">
                    <?php elseif(isset($_POST['ubah']) and $_POST['id'] == $buku['id_buku']) : ?>
                        <button name="konfirmasi">konfirmasi</button>
                        <button name="batal">batal</button>
                    <?php endif ?>
                </form>
            </td>
            </tr>
        <?php } ?>
    </table>
    <form action="" method="post">
        <label for="">kategori</label>
        <input type="text" name="kategori">
        <label for="">nama buku</label>
        <input type="text" name="namabuku">
        <label for="">harga</label>
        <input type="number" name="harga">
        <label for="">stok</label>
        <input type="number" name="stok">
        <select name="penerbit" id="">
            <option value="">pilih penerbit</option>
            <?php foreach(mysqli_query($conn, "select * from penerbit") as $terbit) { ?>
                <option value="<?= $terbit['id_penerbit'] ?>"><?= $terbit['nama'] ?></option>
            <?php } ?>
        </select>
        <input type="submit" value="tambah" name="tambahh">
    </form>
<?php } ?>