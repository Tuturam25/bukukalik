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

if(isset($_POST['konfirmasi'])) {
    $kategori = $_POST['kategori'];
    $namabuku = $_POST['namabuku'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $penerbit = $_POST['penerbit'];
    $id_buku = $_POST['id_buku'];
    mysqli_query($conn, "update buku set kategori = '$kategori', namabuku = '$namabuku', harga = '$harga', stok = '$stok', penerbit = '$penerbit' where id_buku = '$id_buku'");
    header('refresh: 0');
}

?>

<div class="">
    <form action="" method="get">
        <input type="submit" name="home" value="home">
        <input type="submit" name="admin" value="admin">
        <input type="submit" name="pengadaan" value="pengadaan">
    </form>
</div>

<?php if(isset($_GET['admin'])) { ?>
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
<?php } ?>

<?php if(isset($_GET['pengadaan'])) { ?>
    <table border="1">
        <tr>
            <th>kategori</th>
            <th>nama buku</th>
            <th>harga</th>
            <th>stok</th>
            <th>nama penerbit</th>
            <th>aksi</th>
        </tr>
        <?php foreach(mysqli_query($conn, 'select * from buku join penerbit on buku.penerbit = penerbit.id_penerbit') as $buku) { ?>
        <tr>
            <td>
                <form action="" method="post">
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