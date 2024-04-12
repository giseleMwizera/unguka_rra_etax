<?php

?>
<div class="container-rg">
    <header>E-TAX Payment Transfer</header>
    <div class="progress-bar">
        <div class="step">
            <p>
                Name
            </p>
            <div class="bullet">
                <span>1</span>
            </div>
            <div class="check fas fa-check"></div>
        </div>
        <div class="step">
            <p>
                Contact
            </p>
            <div class="bullet">
                <span>2</span>
            </div>
            <div class="check fas fa-check"></div>
        </div>
        <div class="step">
            <p>
                Birth
            </p>
            <div class="bullet">
                <span>3</span>
            </div>
            <div class="check fas fa-check"></div>
        </div>
        <div class="step">
            <p>
                Submit
            </p>
            <div class="bullet">
                <span>4</span>
            </div>
            <div class="check fas fa-check"></div>
        </div>
    </div>
    <form action="http://10.22.99.100/unguka_rra/controllers/docInquiry.php" method="get" class="pay">
        <div class="form first-py">
            <div class="details personal">
                <span class="title">Document lookup</span>

                <div class="fields-py">
                    <div class="input-field">
                        <label>RRA Reference no</label>
                        <input type="text" name="docId" required>
                    </div>

                    <button class="inquireBtn" type="submit">
                        <span class="btnText">Inquire</span>
                        <i class="uil uil-search-alt"></i>
                    </button>
                </div>
            </div>
    </form>

    <div class="details ID">
        <span class="title">Document Details</span>

        <div class="fields">
            <div class="input-field">
                <label>RRA Reference</label>
                <input type="text" name="RRAref">
            </div>

            <div class="input-field">
                <label>Tax Center Description</label>
                <input type="text" name="tcDesc">
            </div>

            <div class="input-field">
                <label>Tax Center</label>
                <input type="text" name="tCenter">
            </div>


            <div class="input-field">
                <label>Tax Type</label>
                <input type="text" name="tType">
            </div>
            <div class="input-field">
                <label>Tax Type Description</label>
                <input type="text" name="ttyDesc">
            </div>
            <div class="input-field">
                <label>Declaration Id</label>
                <input type="number" name="decId">
            </div>
            <div class="input-field">
                <label>TIN</label>
                <input type="text" name="tin">
            </div>
            <div class="input-field">
                <label>Declaration Date</label>
                <input type="date" name="decDate">
            </div>
            <div class="input-field">
                <label>Tax Payer's Name</label>
                <input type="text" name="payerName">
            </div>

            <div class="input-field">
                <label>Amount</label>
                <input type="number" name="amt">
            </div>
            <div class="input-field">
                <label>RRA Origin number</label>
                <input type="number" name="origNum">
            </div>
            <div class="input-field">
                <label>Assessment number</label>
                <input type="number" name="assessNo">
            </div>

        </div>
        <div class="py-buttons">
            <button class="cancelBtn">
                <span class="btnText">Cancel</span>
                <i class="uil uil-times"></i>
            </button>
            <button class="nextBtn">
                <span class="btnText">Proceed</span>
                <i class="uil uil-navigator"></i>
            </button>
        </div>
    </div>

</div>

</div>
