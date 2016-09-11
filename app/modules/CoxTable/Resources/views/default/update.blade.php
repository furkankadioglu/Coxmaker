@extends('CoxTable::default.main')

@section('styles')
<style>
  .mainBorder
  {
    border: 2px solid green;
  }
</style>
<script>
  function findTotal(personID){
    var arr = document.getElementsByClassName(personID);
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value) && parseInt(arr[i].value) < 99 && parseInt(arr[i].value) > 0)
            tot += parseInt(arr[i].value);
    }
    if(tot != 100)
    {
      document.getElementById(personID).innerHTML = '';
      document.getElementById(personID).innerHTML += '<div class="bg-danger"><br /> The sum of the total has to be <strong>100</strong>. (' + tot + ')<br /><br /></div>';
      document.getElementById("sub").disabled = true;

    }
    else
    {
      document.getElementById(personID).innerHTML = '';
      document.getElementById("sub").disabled = false;
    }
}

</script>
@endsection

@section('content')


      <div class="row">
      <br><br>
           <form method="post" action="{{ url('/CoxTable') }}">
            <input type="hidden" name="postCategory" value="edit" />
            <input type="hidden" name="tableId" value="{{ $table->id }}" />
            <input type="hidden" name="mainPersonId" value="{{ $mainPerson->id }}" />
          
           <div class="row">
             <div class="col-md-6 justify"><h2>{{ $table->name }} <br><small>[<a href="{{ url('/CoxTable/'.$table->key) }}">Results</a>]</small></h2></div>
           </div>
           <br><br>
            @foreach($table->persons as $person)
        
                <div class="col-md-6 col-md-offset-3 text-center"> <p id="{{ $person->id }}" class="text-center"></p></div>

            @endforeach

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
                    <th colspan="2" class="bg-danger text-center">Names</th>
                    <th colspan="{{ $table->jobs->count() }}" class="bg-warning text-center">Roles</th>
                  </tr>
                  <tr>
                    <th colspan="2">Names</th>
                    @foreach($table->jobs as $is)
                    <th class="text-center">
                    {{ $is->name }}
                    <input type="hidden" name="isler[]" value="{{ $is->name }}">
                    </th>
                    @endforeach
                  </tr>
              </thead>
              <tbody>
              	@foreach($table->persons as $person)
                  <tr>
                     <td class="cantbesmall" colspan="2">
                     @if($person->id == $mainPerson->id)
                    <strong><u>{{ $person->name }}</u></strong>
                     @else
                    <strong>{{ $person->name }}</strong>
                     @endif
                          <input type="hidden" name="ortaklar[]" value="{{ $person->name }}">

                   
                    </td>
                    @foreach($table->jobs as $is)
                    <td class="text-center">
                          <input type="text" onfocus="this.value = ''" onblur="findTotal({{ $person->id }})" name="veriler[{{ $person->id }}][{{ $is->id }}]" class="form-control {{ $person->id }}" value="{{ $person->result($is->id)->point or '' }}" {{ ($person->id == $mainPerson->id) ? "" : "disabled" }}>
                    </td>
                    @endforeach
                    <td>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
           </div>
           <div class="col-md-12 text-left">
              {{ csrf_field() }}
  <div class="pull-right">{!! app('captcha')->display(); !!}</div> <br>

              <button type="submit" id="sub" class="btn btn-primary btn-lg pull-left" disabled="">Save</button>
           </div>
           </form>
      </div>
             





  


@endsection