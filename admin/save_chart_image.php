<?php
$data = json_decode(file_get_contents('php://input'), true);
if (!empty($data['image'])) {
    $img = str_replace('data:image/png;base64,', '', $data['image']);
    $img = str_replace(' ', '+', $img);
    file_put_contents('chart.png', base64_decode($img));
    echo 'Saved';
} else {
    echo 'No image data';
}
?>
