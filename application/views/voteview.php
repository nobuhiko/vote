<html>
<head>
<title>投票</title>
</head>
<body>
    <h1>投票フォーム</h1>


<?php foreach ($movie_list as $group_id => $groups):?>
<ul>

<?php foreach ($groups as $item):?>
<li>
<?php echo $item;?>
<?php
$hidden = array('group_id' => $group_id, 'movie_id' => $item);
echo form_open('', '', $hidden);
echo form_submit('submit', '投票する');
echo form_close();
?>
</li>

<?php endforeach;?>
</ul>
<?php endforeach;?>

</body>
</html>
