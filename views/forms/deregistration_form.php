<?php

include("config.php");
?>
<<<<<<< HEAD
    
<div class="container-rg" >
<header>Deregister user accounts</header>

<form action="http://10.22.99.100/unguka_rra/bp_deregister.php" method="post" class="reg">
    <div class="form first-py">
        <div class="details personal" >
            <span class="title"></span>
             <div id="userFieldsContainer">
             <div class="fields-py">
                <div class="input-field">
                    <label>Account</label>
                    <input type="text" placeholder="Type in the tax payer account" name="account[]" required>
                </div>
                <div class="input-field">
                    <label>TIN number</label>
                    <input type="number" placeholder="Type in the tax payer TIN" name="tin[]" required>
                </div>
            </div>
             </div>
            
               <div class="addBtn">
                    <i class="uil uil-plus-circle"></i>
                <span class="">Add more accounts</span>
             </div>
</div>
=======

<div class="container-rg">
    <header>Deregister user accounts</header>

    <form action="http://10.22.99.100/unguka_rra/bp_deregister.php" method="post" class="reg">
        <div class="form first-py">
            <div class="details personal">
                <span class="title"></span>
                <div id="userFieldsContainer">
                    <div class="fields-py">
                        <div class="input-field">
                            <label>Account</label>
                            <input type="text" placeholder="Type in the tax payer account" name="account[]" required>
                        </div>
                        <div class="input-field">
                            <label>TIN number</label>
                            <input type="number" placeholder="Type in the tax payer TIN" name="tin[]" required>
                        </div>
                    </div>
                </div>

                <div class="addBtn">
                    <i class="uil uil-plus-circle"></i>
                    <span class="">Add more accounts</span>
                </div>
            </div>
>>>>>>> 52cbd6e (Initial commit)


            <button class="nextBtn" type="submit">
                <span class="btnText">Deregister payer</span>
                <i class="uil uil-navigator"></i>
            </button>
<<<<<<< HEAD
    </div>
</form>
<div id="userList"></div>
</div>

=======
        </div>
    </form>
    <div id="userList"></div>
</div>
>>>>>>> 52cbd6e (Initial commit)
