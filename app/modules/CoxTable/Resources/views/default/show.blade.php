@extends('CoxTable::default.main')

@section('styles')
<script>
    var realTotal = 0;

function getSum(jobID, jobCount)
{
    var arr = document.getElementsByClassName(jobID);
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value) && parseInt(arr[i].value) < 99 && parseInt(arr[i].value) > 0)
            tot += parseInt(arr[i].value);
    }

    document.getElementById(jobID).innerHTML = "%" + (tot / jobCount) ;

}
</script>
@endsection

@section('content')


      <div class="row">
      <br><br>
           <form method="post" action="[[[ url('/CoxTable') ]]]">
            <input type="hidden" name="postCategory" value="edit" />
            <input type="hidden" name="tableId" value="{{ $table->id }}" />
          
           <div class="row">
             <div class="col-md-6 justify"><h2>{{ $table->name }} Results</h2></div>
           </div>
           <br><br>
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
                    <strong>{{ $person->name }}</strong>
                          <input type="hidden" name="ortaklar[]" value="{{ $person->name }}">

                   
                    </td>
                    @foreach($table->jobs as $is)
                    <td class="text-center">
                          <input type="text" name="veriler[{{ $person->id }}][{{ $is->id }}]" value="{{ $person->result($is->id)->point or '' }}" class="form-control {{ $is->id }}" disabled="">
                    </td>
                    @endforeach
                  </tr>
                  @endforeach
              
                  <tr>
                    <td colspan="2">
                      <strong>Results</strong>
                    </td>
                     @foreach($table->jobs as $is)
                    <td>
                      <div id="{{ $is->id }}" class="text-center"></div>
                    </td>
                    <script>
                      getSum({{ $is->id}}, {{ count($table->persons) }});
                    </script>
                    @endforeach
                  </tr>
              </tbody>

            </table>
           </div>
             </form>
      </div>





  


@endsection