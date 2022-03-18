@extends('backend.main_b.dashboard')

@section('title')
    Store Dashboard Account
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">My Account</h2>
        <p class="dashboard-subtitle"> Look what you made today!</p>
      </div>
      
      <div class="dahsboard-content">
        <div class="row">
          <div class="col-12">
            <form action="">
              <div class="card">
                <div class="card-body">
                  <div class="row" >
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="adrresOne"> Your Name</label>
                        <input type="text" class="input form-control" id="name" name="name" value="Meyzan Duta"></input>
                      </div>
                    </div>
        
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="addressTwo"> Your Email</label>
                        <input type="email" class="input form-control" id="email" name="email" value="email16.email.com"></input>
                      </div>
                    </div>


                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="adrresOne"> Address 1</label>
                        <input type="text" class="input form-control" id="adrresOne" name="adrresOne" value="Setra Duta"></input>
                      </div>
                    </div>
        
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="addressTwo"> Address 2</label>
                        <input type="text" class="input form-control" id="addressTwo" name="addressTwo" value="BLOK 2 JKR"></input>
                      </div>
                    </div>
        
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="province"> Province </label>
                        <select name="province" id="province" class="form-control">
                          <option value="Wet Jave">West Java</option>
                        </select>
                      </div>
                    </div>
        
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="city"> City </label>
                        <select name="city" id="city" class="form-control">
                          <option value="Bandung">Bandung</option>
                        </select>
                      </div>
                    </div>
        
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="postalCode">Postal Code</label>
                        <input type="text" class="input form-control" id="postalCode" name="postalCode" value="40152"></input>
                      </div>
                    </div>
        
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="input form-control" id="country" name="country" value="Indonesia"></input>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="mobile">Mobile </label>
                        <input type="text" class="input form-control" id="mobile" name="mobile" value="+628 2020 11111"></input>
                      </div>
                    </div>          
                  </div>

                  <div class="row">
                    <div class="col text-right">
                      <button type="submit" class="btn btn-success px-5">
                        Save Now
                      </button>
                    </div>
                  </div>
                  
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>

    </div>
   </div>
@endsection