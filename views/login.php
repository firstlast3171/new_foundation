

<form action="/login" method="post">
     <input type="text" name="name" placeholder="name" value="<?php echo $values["name"] ?? "" ?>">
   <p><?php echo $errors->getFirstError("name"); ?></p>
     <input type="email" name="email" placeholder="email" value="<?php echo $values["email"] ?? "" ?>">
     <p><?php echo $errors->getFirstError("email"); ?></p>
     <input type="password" name="password" placeholder="password" value="<?php echo $values["password"] ?? "" ?>">
     <p><?php echo $errors->getFirstError("password"); ?></p>
     <input type="password" name="confirmpassword" placeholder="confirmpassword" value="<?php echo $values["confirmpassword"] ?? "" ?>">
     <p><?php echo $errors->getFirstError("confirmpassword"); ?></p>
     <button type="submit">Submit</button>
</form>