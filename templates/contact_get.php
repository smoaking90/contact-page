<section>
    <h2>Leave a Note/Question</h2>
    <form method="POST">
    <!-- CSRF -->
     <input type="hidden" name="csrf_token" value="<?=$data['csrf_token']?>"/>

    <label>Name</label>
    <input type="text" name="name">

    <label>Email</label>
    <input type="text" name="email"> <!--is put as type text rather than email just to show email error message. -->

    <label>Message</label>
    <textarea rows="4" name="message"></textarea>

    <button type="submit">Send Message</button>

    </form>
</section>