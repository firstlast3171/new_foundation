<h1><?= $auth["name"] ?></h1> 
<?php if($auth["name"] === "BhoneThit"): ?>
 <b>Welcome admin</b>
 <form action="/add" method="post">
     <textarea rows="10" cols="20" type="text" placeholder="Something" name="add" ><?php echo $values["add"] ?? "" ?></textarea>
     <p><?php echo $errors->getFirstError("add") ?? "" ?></p>

     <input type="text" name="category" value="<?php echo $values["category"] ?? "" ?>">
     <p><?php echo $errors->getFirstError("category") ?? "" ?></p>

     <button type="submit">Add</button>
</form>
 <?php else: ?>
<b>You are not admin</b>
<?php endif ?>



<form action="/logout" method="post">
<button type="submit">Logout</button>
</form>

<?php foreach($items as $item): ?>
<div style="border: 1px solid black; padding:10px; border-radius:20px; margin:10px;">
     <p><?= $item["body"] ?></p>
     <a href="add/post?id=<?= $item["id"] ?>"><?= $item["category"] ?></a>
    
</div>
<?php endforeach; ?>




