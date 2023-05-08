<form action="/test" method="post">
     <textarea rows="10" cols="20" type="text" placeholder="Something" name="test" ><?php echo $values["test"] ?? "" ?></textarea>
     <p><?php echo $errors->getFirstError("test") ?? "" ?></p>

     <button type="submit">Submit</button>
</form>

<form action="/logout" method="post">
<button type="submit">Logout</button>
</form>