<script>
let timer, currSeceond = 0;

function resetTimer() {
    clearInterval(timer);
    currSeceond = 0;
    timer = setInterval(startIdleTimer, 2000);

}

window.onload = resetTimer;
window.onmousemove = resetTimer;
window.onmousedown = resetTimer;
window.ontouchstart = resetTimer;
window.onclick = resetTimer;
window.onkeypress = resetTimer;

function startIdleTimer() {
    currSeceond++;
    if (currSeceond > 60) {
        <?php
            $username = $_SESSION['USER_USERNAME'];
            $sql = "update `user` set status = '0' where email = '$username'";
            mysqli_query($con, $sql);
            ?>
    }
}
</script>