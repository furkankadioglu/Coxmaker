@extends('CoxTable::default.main')

@section('content')


    <div ng-controller="TableController as t">
    <div ng-controller="OrtakController as o">
    <div ng-controller="IsController as i">
      <div class="row">
      <br><br>
           <form method="post" action="[[[ url('/CoxTable') ]]]" novalidate autocomplete="off">
            <input type="hidden" name="postCategory" value="create" />
           <div class="row">
             <div class="col-md-6 justify"><h2>{{ t.name }}</h2></div>
             <div class="col-md-6 justify"><br><input type="text" name="projectname" onfocus="this.value = ''" class="form-control btn-lg" ng-model="t.name"></div>
           </div>
           <br><br>
           <p class="bg-primary text-center">
           <br>
             First, add the projects, then add the selection panel (or partners) that will determine the ratios. After this input, Coxmaker will send out an email to all parties for them to submit their scores; once all scoring is over the system will calculate the right distribution. 
             <br>
             <br>
           </p>
           <br><br>
           @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
           <div class="col-md-12">
              <table class="table table table-striped">
              <thead>
                  <tr>
                    <th colspan="2" class="bg-danger text-center">Names ({{ totalUserCount() }})</th>
                    <th colspan="{{ totalCount() }}" class="bg-warning text-center">Roles ({{ totalCount() }})</th>
                  </tr>
                  <tr>
                    <th>Names</th>
                    <th>Emails</th>
                    <th ng-repeat="a in i.list" class="text-center">
                    {{ a.adi }} <button ng-click="i.destroy($index)"><i class="glyphicon glyphicon-remove"></i></button>
                    <input type="hidden" name="isler[]" value="{{ a.adi }}">
                    </th>
                  </tr>
              </thead>
              <tbody>
                  <tr ng-repeat="b in o.list">
                     <td class="cantbesmall">
                    <strong>{{ b.isim }}</strong>
                          <input type="hidden" name="ortaklar[]" value="{{ b.isim }}">

                    <div class="pull-right"> <button ng-click="o.destroy($index)"><i class="glyphicon glyphicon-remove"></i> </button>
                    </div>
                    </td>
                    <td>
                          <input type="text" name="emailler[]" class="form-control" value="">
                    </td>
                    <td ng-repeat="a in columnCount()" class="text-center">
                          <input type="text" class="form-control" disabled="">
                    </td>
                  </tr>
              </tbody>
            </table>
           </div>
           <div class="col-md-12 text-left">
              [[[ csrf_field() ]]]
  <div class="pull-right">{!! app('captcha')->display(); !!}</div> <br>

              <button type="submit" class="btn btn-primary btn-lg pull-left">Send Invitations</button>
           </div>
      </div>
             </form>



      <br><br>
      <div class="row">
            <div class="col-md-6 text-center">
        <form ng-submit="o.add()">
          <input type="text" ng-model="o.isim" class="form-control" size="30" placeholder="Person Name">
          <br>
          <input class="btn btn-primary" type="submit" value="Add">
        </form>
      </div>

      

      <div class="col-md-6 text-center">
        <form ng-submit="i.add()">
          <input type="text" ng-model="i.adi" class="form-control"  size="30" placeholder="Departmant Name">
          <br>
          <input class="btn btn-primary" type="submit" value="Add">
        </form>
      </div>
      </div>





      </div>
    </div>
    </div>
    </div>


@endsection