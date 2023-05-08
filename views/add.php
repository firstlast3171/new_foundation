<form action="/add" method="post">
     <textarea rows="10" cols="20" type="text" placeholder="Something" name="add" ><?php echo $values["add"] ?? "" ?></textarea>
     <p><?php echo $errors->getFirstError("add") ?? "" ?></p>

     <input type="text" name="category" value="<?php echo $values["category"] ?? "" ?>">
     <p><?php echo $errors->getFirstError("category") ?? "" ?></p>

     <button type="submit">Add</button>
</form>

<form action="/logout" method="post">
<button type="submit">Logout</button>
</form>