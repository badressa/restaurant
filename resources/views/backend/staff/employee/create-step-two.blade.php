<form action="{{ route('staff.create.step.two.post') }}" method="POST">
@csrf
    <input type="text" name="salaire" >

    <button type="submit">sub</button>


</form>