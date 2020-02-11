<?php
$title = "Registration";
include("./top_down/header.html");
// $religion = array(1=>"Christian","muslim","others");
echo "<div class='container py-5 my-2 rounded  px-3'>";
$errors = array();
require_once("SQL.php");
if (isset($_POST['Submitted'])) {
    if (!empty($_POST['first_name'])) {
        $fn = mysqli_real_escape_string($db, stripslashes(trim($_POST['first_name'])));
    } else {
        $fn = NULL;
        $errors[] = "Input your surname";
    };
    if (!empty($_POST['middle_name'])) {
        $mn = mysqli_real_escape_string($db, stripslashes(trim($_POST['middle_name'])));
    } else {
        $mn = NULL;
        $errors[] = "Input your middle name";
    };
    if (!empty($_POST['last_name'])) {
        $ln = mysqli_real_escape_string($db, stripslashes(trim($_POST['last_name'])));
    } else {
        $ln = NULL;
        $errors[] = "Input your last name";
    };
    if ($_POST['religion'] != 'nil') {
        $religion = mysqli_real_escape_string($db, stripslashes(trim($_POST['religion'])));
    } else {
        $religion = NULL;
        $errors[] = "Input your religion please";
    };
    $other_r = NULL;
    if (!empty($_POST['other_r'])) {
        $other_r = mysqli_real_escape_string($db, stripslashes(trim($_POST['other_r'])));
    } else {
        if ($_POST['religion'] == 'Others') {
            $other_r = NULL;
            $errors[] = "input your religion name";
        }
    };
    if (!empty($_POST['department'])) {
        $dept = mysqli_real_escape_string($db, stripslashes(trim($_POST['department'])));
    } else {
        $dept = NULL;
        $errors[] = "Input the name of your department";
    };
    if (!empty($_POST['denomination'])) {
        $deno = mysqli_real_escape_string($db, stripslashes(trim($_POST['denomination'])));
    } else {
        $errors = "Input your denomination ";
    };
    if (!empty($_POST['residential_address'])) {
        $r_add = mysqli_real_escape_string($db, stripslashes(trim($_POST['residential_address'])));
    } else {
        $r_add = NULL;
        $errors[] = "Input your address";
    };
    if (!empty($_POST['P_Home_address'])) {
        $P_add = mysqli_real_escape_string($db, stripslashes(trim($_POST['P_Home_address'])));
    } else {
        $P_add = NULL;
        $errors[] = "Input your permanent home address";
    };
    if (!empty($_POST['personal_file_number'])) {
        $pf_no = $_POST['personal_file_number'];
    } else {
        $pf_no = 0;
        $errors[] = "Input your OAUTHC Personal File Number";
    };
    if (isset($_POST['old_member'])) {
        $old_m = $_POST['old_member'];
    } else {
        $old_m = NULL;
        $errors[] = "have you ever joined the society";
    };

    if ((empty($_POST['membership_no'])) && ($old_m == 'False')) {
        $old_mem_no = $_POST['membership_no'];
    } else if ((!empty($_POST['membership_no'])) && ($old_m == 'True')) {
        $old_mem_no = $_POST['membership_no'];
    } else {
        $old_mem_no = 0;
        $errors[] = "Input your old membership_no";
    };



    $nk1_name =         mysqli_real_escape_string($db, stripslashes(trim($_POST['N1_first_name']))) . '  ' . mysqli_real_escape_string($db, stripslashes(trim($_POST['N1_last_name'])));
    $nk1_relationship = mysqli_real_escape_string($db, stripslashes(trim($_POST['N1_relationship'])));
    $nk1_address =      mysqli_real_escape_string($db, stripslashes(trim($_POST['N1_address'])));
    $nk2_name =         mysqli_real_escape_string($db, stripslashes(trim($_POST['N2_first_name']))) . '  ' . mysqli_real_escape_string($db, stripslashes(trim($_POST['N2_last_name'])));
    $nk2_relationship = mysqli_real_escape_string($db, stripslashes(trim($_POST['N2_relationship'])));
    $nk2_address =       mysqli_real_escape_string($db, stripslashes(trim($_POST['N2_address'])));
    $sp1_name  =        mysqli_real_escape_string($db, stripslashes(trim($_POST['sp1_name'])));
    $sp1_pf_no =         $_POST['sp1_personal_file_number'];
    $sp1_CPLN  =         $_POST['sp1_Coop_no'];
    $sp1_deno  =        mysqli_real_escape_string($db, stripslashes(trim($_POST['sp1_denomination'])));
    $sp2_name  =        mysqli_real_escape_string($db, stripslashes(trim($_POST['sp2_name'])));
    $sp2_pf_no =         $_POST['sp2_personal_file_number'];
    $sp2_CPLN  =         $_POST['sp2_Coop_no'];
    $sp2_deno  =        mysqli_real_escape_string($db, stripslashes(trim($_POST['sp2_denomination'])));
    if (!empty($errors)) {
        echo "<p class='error'>";
        foreach ($errors as $error) {
            echo "$error <br>";
        };
        echo "</p>";
    } else {
        $q = "INSERT INTO registration (SN, First_name, Middle_name, Last_name, Religion, Other_r, Department, Denomination, `Address`, Permanent_address, Personal_file_number, New_member, Old_membership_no, NOK1_name, NOK1_relationship, NOK1_address, NOK2_name, NOK2_relationship, NOK2_address, SP1_name, SP1_denomination, SP1_personal_file_no, SP1_COOP_no, SP2_name, SP2_denomination, SP2_personal_file_no, SP2_COOP_no) VALUES (NULL,'$fn' ,'$mn', '$ln', '$religion','$other_r', '$dept', '$deno', '$r_add', '$P_add', '$pf_no', '$old_m','$old_mem_no', '$nk1_name', '$nk1_relationship', '$nk1_address', '$nk2_name', '$nk2_relationship', '$nk2_address','$sp1_name' , '$sp1_deno' , '$sp1_pf_no', '$sp1_CPLN' ,'$sp2_name' , '$sp2_deno' , '$sp2_pf_no', '$sp2_CPLN' )";
        $r = @mysqli_query($db, $q);
        if ($r) {
            echo '<p>You are now registered in this website <a href="index.php"></a><br/> </p>';
        } else {
            echo '<h1>System error</h1>
                <p>you could not register due to system error we apologize for any inconvenience.</p>';
            echo '<p>' . mysqli_error($db) . '<br/><br/>Query:' . $q . '</p>';
        }
        mysqli_close($db);
        include('top_down/footer.html');
        exit();
    };
}

?>
<div class="row">
    <div class="col">
        <div class="container  py-5 rounded shadow px-3 bg-light">
            <form action="registration.php" method="post" class="form-group px-3">
                <div class="row">
                    <div class="col text-center text-capitalize">
                        <H1>membership enrolment form</H1>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 col-sm-12 col-lg">
                        <label class="icon" for="first_name">First name: </label>
                        <input type="text" class="form-control" name="first_name" required
                            value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg">
                        <label class="icon" for="middle_name">Middle name: </label>
                        <input type="text" class="form-control" name="middle_name" required
                            value="<?php if (isset($_POST['middle_name'])) echo $_POST['middle_name']; ?>">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg">
                        <label class="icon" for="last_name">Last name: </label>
                        <input type="text" class="form-control" name="last_name" required
                            value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <label class="icon" for="religion">religion: </label>
                        <select name="religion" id="drop_down" class="form-control" id="exampleFormControlSelect2">
                            <option value=nil>.....</option>
                            <option value="Christian">Christian</option>
                            <option value="Muslim">Muslim</option>
                            <option value="Others">Others</option>
                        </select>
                        <br />
                    </div>
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <label class="icon" for="other_r">IF others, name?</label>
                        <input type="text" class="form-control" name="other_r"
                            value="<?php if (isset($_POST['other_r'])) echo $_POST['other_r']; ?>">
                        <br>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <label class="icon" for="denomination">Denomination: </label>
                        <input type="text" class="form-control" name="denomination" required
                            value="<?php if (isset($_POST['denomination'])) echo $_POST['denomination']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label class="icon" for="department">department: </label>
                        <input type="text" class="form-control" name="department" required
                            value="<?php if (isset($_POST['department'])) echo $_POST['department']; ?>">
                    </div>

                </div>
                <label class="icon" for="residential_address">Residential address: </label>
                <input type="text" class="form-control" name="residential_address" required
                    value="<?php if (isset($_POST['residential_address'])) echo $_POST['residential_address']; ?>">
                <br />
                <label class="icon" for="P_Home_address">Permanent Home address: </label>
                <input type="text" class="form-control" name="P_Home_address" required
                    value="<?php if (isset($_POST['P_Home_address'])) echo $_POST['P_Home_address']; ?>">
                <br />
                <label class="icon" for="personal_file_number">OAUTHC Personal File Number: </label>
                <input type="number" class="form-control" name="personal_file_number" required
                    value="<?php if (isset($_POST['personal_file_number'])) echo $_POST['personal_file_number']; ?>">
                <br />
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label class="icon" for="old_member">Have you ever joined this society <b>?</b> </label>
                        <label for="old_member">Yes</label>
                        <input type="radio" name="old_member" value="True">
                        <label for="old_member">No</label>
                        <input type="radio" name="old_member" value="False">
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label class="icon" for="membership_no">If yes what was your membership no: </label>
                        <input type="number" class="form-control" name="membership_no"
                            value="<?php if (isset($_POST['membership_no'])) echo $_POST['membership_no']; ?>">
                    </div>
                </div>
                <div class="row">
                    <label for="Next_of_kin"><b>Next Of Kin</b></label>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg rounded-left shadow-sm p-5">
                        <h6>1</h6>
                        <label class="icon" for="N1_first_name">First name: </label>
                        <input type="text" class="form-control" required
                            value="<?php if (isset($_POST['N1_first_name'])) echo $_POST['N1_first_name']; ?>"
                            name="N1_first_name">
                        <label class="icon" for="N1_last_name">Last name: </label>
                        <input type="text" class="form-control" required
                            value="<?php if (isset($_POST['N1_last_name'])) echo $_POST['N1_last_name']; ?>"
                            name="N1_last_name">
                        <br>
                        <label class="icon" for="N1_relationship">Relationship:</label>
                        <input type="text" class="form-control" required
                            value="<?php if (isset($_POST['N1_relationship'])) echo $_POST['N1_relationship'] ?>"
                            name="N1_relationship">
                        <br>
                        <label class="icon" for="N1_address">Contact Address</label>
                        <input type="text" class="form-control" required
                            value="<?php if (isset($_POST['N1_address'])) echo $_POST['N1_adress'] ?>"
                            name="N1_address">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg rounded-right shadow-sm p-5">
                        <h6>2</h6>
                        <label class="icon" for="N2_first_name">First name: </label>
                        <input type="text" class="form-control" name="N2_first_name"
                            value="<?php if (isset($_POST['N2_first_name'])) echo $_POST['N2_first_name']; ?>">
                        <label class="icon" for="N2_last_name">Last name: </label>
                        <input type="text" class="form-control" name="N2_last_name"
                            value="<?php if (isset($_POST['N2_last_name'])) echo $_POST['N2_last_name']; ?>">
                        <br>
                        <label class="icon" for="N2_relationship">Relationship:</label>
                        <input type="text" class="form-control" name="N2_relationship"
                            value="<?php if (isset($_POST['N2_relationship'])) echo $_POST['N2_relationship']; ?>">
                        <br>
                        <label class="icon" for="N2_address">Contact Address</label>
                        <input type="text" class="form-control" name="N2_adress"
                            value="<?php if (isset($_POST['N2_address'])) echo $_POST['N2_address']; ?>"></li>
                    </div>
                </div>
                <div class="row">
                    <Label><b>SPONSOR(S) RECOMMENATION</b></Label>
                </div>
                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-lg rounded-left shadow-sm p-5">
                        <h6>1</h6>
                        <Label class="icon" for="sp1_name">Sponsor's Name</Label>
                        <input type="text" class="form-control" name="sp1_name" required
                            value="<?php if (isset($_POST['sp1_name'])) echo $_POST['sp1_name']; ?>">
                        <br />
                        <label class="icon" for="sp1_denomination">Denomination: </label>
                        <input type="text" class="form-control" name="sp1_denomination"
                            value="<?php if (isset($_POST['sp1_denomination'])) echo $_POST['sp1_denomination']; ?>"
                            required>
                        <br />
                        <label class="icon" for="sp1_personal_file_number">OAUTHC Personal File Number: </label>
                        <input type="number" class="form-control" name="sp1_personal_file_number" required
                            value="<?php if (isset($_POST['sp1_personal_file_number'])) echo $_POST['sp1_personal_file_number']; ?>">
                        <label class="icon" for="sp1_Coop_no">Coop Personal Ledger No</label>
                        <input type="number" class="form-control" name="sp1_Coop_no" required
                            value="<?php if (isset($_POST['sp1_Coop_no'])) echo $_POST['sp1_coop_no']; ?>">
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg rounded-left shadow-sm p-5">
                        <h6>2</h6>
                        <Label class="icon" for="sp2_name">Sponsor's Name</Label>
                        <input type="text" class="form-control" name="sp2_name"
                            value="<?php if (isset($_POST['sp2_name'])) echo $_POST['sp2_name']; ?>">
                        <br />
                        <label class="icon" for="sp2_denomination">Denomination: </label>
                        <input type="text" class="form-control" name="sp2_denomination"
                            value="<?php if (isset($_POST['sp2_denomination'])) echo $_POST['sp2_denomination']; ?>">
                        <br />
                        <label class="icon" for="sp2_personal_file_number">OAUTHC Personal File Number: </label>
                        <input type="number" class="form-control" name="sp2_personal_file_number"
                            value="<?php if (isset($_POST['sp2_personal_file_number'])) echo $_POST['sp2_personal_file_number']; ?>">
                        <label class="icon" for="sp2_Coop_no">Coop Personal Ledger No</label>
                        <input type="number" class="form-control" name="sp2_Coop_no"
                            value="<?php if (isset($_POST['sp2_Coop_no'])) echo $_POST['sp2_coop_no']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <br>
                        <button class="btn btn-primary " type="submit" name="Submitted">register</button>
                        <input type="hidden" name="Submitted" value="TRUE">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
echo "</div>";
include("./top_down/footer.html")
?>