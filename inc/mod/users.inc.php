<?php
if (!defined("IN_MOD"))
{
	die("Nah, I won't serve that file to you.");
}
reqPermission(2);
	?>
		<div class="box-outer top-box">
<div class="box-inner">
<div class="boxbar"><h2><?php echo $lang['mod/new_user']; ?></h2></div>
<div class="boxcontent">
<form action="?/users/add" method="POST">
<?php echo $lang['mod/username']; ?>: <input type="text" name="username" /><br />
<?php echo $lang['mod/password']; ?>: <input type="password" name="password"/><br />
<?php echo $lang['mod/type']; ?>: <select name="type"><option value="0"><?php echo $lang['mod/janitor']; ?></option><option value="1"><?php echo $lang['mod/moderator']; ?></option><option value="2"><?php echo $lang['mod/administrator']; ?></option></select>

<br /><br />
<?php echo $lang['mod/boards']; ?>: <input type="checkbox" name="all" id="all" onClick="$('#boardSelect').toggle()" value=1/> <?php echo $lang['mod/all']; ?><br/>
<select name="boards[]" id="boardSelect" multiple>
<?php
$result = $conn->query("SELECT * FROM boards;");
while ($row = $result->fetch_assoc())
{
echo "<option onClick='document.getElementById(\"all\").checked=false;' value='",$row['short']."'>/".$row['short']."/ - ".$row['name']."</option>";
}
?>
</select><br />
<input type="submit" value="<?php echo $lang['mod/add_user']; ?>" />
</form>
</div>
</div>
</div><br />
<div class="box-outer top-box">
<div class="box-inner">
<div class="boxbar"><h2><?php echo $lang['mod/all_users']; ?></h2></div>
<div class="boxcontent">
<table>
<thead>
<tr>
<td style="width: 30%;"><?php echo $lang['mod/username']; ?></td>
<td style="width: 20%;"><?php echo $lang['mod/type']; ?></td>
<td style="width: 30%;"><?php echo $lang['mod/boards']; ?></td>
<td style="width: 10%;"><?php echo $lang['mod/edit']; ?></td>
<td style="width: 10%;"><?php echo $lang['mod/delete']; ?></td>
</tr>
</thead>
<tbody>
<?php
$result = $conn->query("SELECT * FROM users;");
$usern = $result->num_rows;
while ($row = $result->fetch_assoc())
{
echo "<tr>";
echo "<td>".$row['username']."</td>";
echo "<td>";
switch ($row['type'])
{
	case 0:
		echo $lang['mod/janitor'];
		break;
	case 1:
		echo $lang['mod/moderator'];
		break;
	case 2:
		echo $lang['mod/administrator'];
		break;
	default:
		echo $lang['mod/faggot'];
		break;
}
echo "</td>";
echo "<td>".$row['boards']."</td>";
echo "<td><a href='?/users/edit&id=".$row['id']."'>".$lang['mod/edit']."</a></td>";
if ($usern != 1)
{
echo "<td><a href='?/users/delete&id=".$row['id']."'>".$lang['mod/delete']."</a></td>";
} else {
echo "<td></td>";
}
echo "</tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>