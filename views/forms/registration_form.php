<?php

include("../config/config.php");
?>

<div class="container-rg">
    <header>Register new tax-pay</header>

    <form method="post" class="reg">
        <div class="form first">
            <div class="details personal">
                <span class="title"></span>
                <div id="userFieldsContainer">

                    <div class="fields">
                        <div class="input-field">
                            <label>Names</label>
                            <input type="text" placeholder="Type in the tax payer names" name="names[]" required>
                        </div>
                        <div class="input-field">
                            <label>Account</label>
                            <input type="text" placeholder="Type in the tax payer account" name="account[]" required>
                        </div>
                        <div class="input-field">
                            <label>TIN number</label>
                            <input type="number" placeholder="Type in the tax payer TIN" name="tin[]" required>

                        </div>
 

                        <div class="input-field">
                            <label>Phone Number</label>
                            <input type="number" placeholder="Type in the tax payer number" name="number[]" required>
                        </div>

                        <div class="input-field">
                            <label>Currency</label>
                            <select id="currency" required name="currency[]">
                                <option disabled selected>Select currency</option>
                                <?php
                                global $db_mysql;
                                $query = "SELECT * FROM currency";

                                $result = mysqli_query($db_mysql, $query);
                                $currencies = array();


                                while ($row = mysqli_fetch_array($result)) {
                                    $value = $row['CurrencyID'];
                                    $text = $row['Description'];

                                ?>
                                    <option value="<?php echo $value; ?>"><?= $text ?></option>

                                <?php

                                }
                                ?>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>National ID</label>
                            <input type="number" placeholder="Type in the tax payer ID" name="NID[]" required>

                        </div>
                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" placeholder="Type in the tax payer email" name="email[]">
                        </div>

                    </div>
                </div>

                <div class="addBtn">
                    <i class="uil uil-plus-circle"></i>
                    <span class="">Add more payers</span>
                </div>
            </div>


            <button class="nextBtn" type="submit">
                <span class="btnText">Register payer</span>
                <i class="uil uil-navigator"></i>
            </button>
        </div>
    </form>
    <div id="userList"></div>
</div>
