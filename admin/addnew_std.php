<div class="container">
    <form method="post" action="process.php?sectn=<?=$sec?>&add_std&operator=<?=$operator;?>" enctype="multipart/form-data">
        <?php
            if(isset($_GET['msg'])){
                echo $_GET['msg'];
            }
            ?>
        <br/>
        <br/>
        <h6 class="text-info">Student Information</h6>
            <br/>
            <br/>
        <div class="row">
            <div class="col-4">
                 <label>Class<span class="text-danger">*</span></label>
                    <select name="cls_id" class="form-control text-capitalize" required="">
                         <option value="">select term</option>
                           <?php
                            $class = $handle->fetchQuery("select * from class where section = '$sec' ");
                             foreach ($class as $view):
                            ?>
                            <option value="<?=$view['cls_id'];?>"><?=$view['cls_name'];?></option>
                            <?php
                            endforeach;
                            ?>
                    </select>

            </div>
        </div>
            <br/>
        <div class="row">
            <div class="col-4">
                <label>Surname<span class="text-danger">*</span></label>
                <input type="text" name="sname" class="form-control" placeholder="Enter Surname" required="">
            </div>
            <div class="col-4">
                <label>Middle Name</label>
                <input type="text" name="mname" class="form-control" placeholder="Enter Middle Name" required="">
            </div>
            <div class="col-4">
                <label>Last Name<span class="text-danger">*</span></label>
                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" required="">
            </div>
        </div>
            <br/>
        <div class="row">
            <div class="col-4">
                <label>Gender <span class="text-danger">*</span></label>
                <select class="form-control" name="gender" required="">
                    <option>select--Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="col-4">
                <label>State of Origin <span class="text-danger">*</span></label>
                <input type="text" name="state" class="form-control" placeholder="Enter State Of Origin" required="">
            </div>
            <div class="col-4">
                <label>Local Government <span class="text-danger">*</span></label>
                <input type="text" name="lga" class="form-control" placeholder="Enter Local Government" required="">
            </div>
        </div>
            <br/>
            <div class="row">
                <div class="col-4">
                    <label>Date OF Birth <span class="text-danger">*</span></label>
                    <input type="date" name="dob" class="form-control" required="">
                </div>
                 <div class="col-4">
                    <label>Current Age <span class="text-danger">*</span></label>
                    <input type="number" name="age" class="form-control" placeholder="Enter Current Age" required="">
                </div>
            </div>
            <br/>
            <div class="row">
                 <h6>Medical report</h6>
            </div>
            <div class="row">
               
                <div class="col-4">
                    <label>Blood Group <span class="text-danger">*</span></label>
                    <input type="text" name="blood_g" class="form-control" placeholder="Enter Blood Group" required="">
                </div>
                 <div class="col-4">
                    <label>Genotype <span class="text-danger">*</span></label>
                    <input type="text" name="genotype" class="form-control" placeholder="Enter Genotype" required="">
                </div>
            </div>
            <br/>
            <div class="row">
                <h6 class="text-info">Family Information</h6>
            </div>
            <br/>
            <div class="row">
                <div class="col-4">
                    <label>Family Name</label>
                    <input type="text" name="fname" class="form-control" placeholder="Enter Family Name" >
                </div>
                <div class="col-4">
                    <label>Fathers Name <span class="text-danger">*</span></label>
                    <input type="text" name="father_name" class="form-control" placeholder="Enter Fathers Name" required="">
                </div>
               
                <div class="col-4">
                    <label>Mothers Name</label>
                    <input type="text" name="mothers_name" class="form-control" placeholder="Enter Mothers Name" required="">
                </div>
                
            </div>
            <br/>
            <div class="row">
                <label>Resedental Address</label>
                <textarea class="form-control" cols="3" name="address"></textarea>
            </div>
            <br/>
            <div class="row">
                <div class="col-4">
                    <label>Phone Number1</label>
                   <input type="number" name="phone1" class="form-control" placeholder="Enter Phone Number" required="">
                </div>
                <div class="col-4">
                    <label>Phone Number 2</label>
                   <input type="number" name="phone2" class="form-control" placeholder="Enter Phone Number" required="">
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-4">
                    <label>Passport</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <br/>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-warning">Submit</button>
            </div>
         
    </form>
</div>