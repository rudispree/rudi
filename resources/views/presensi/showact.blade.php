<ul class="action-button-list">

    <li>
        @if ($dataizin->status=="i")
        <a href="/izinabsen/{{$dataizin->id }}/edit"  class="btn btn-list text-primary">
            <span>
                <ion-icon name="create-outline"></ion-icon>
                Edit Absen
            </span>
        </a>
        @elseif($dataizin->status=="s")
        <a href="/izinsakit/{{$dataizin->id }}/edit"  class="btn btn-list text-primary">
            <span>
                <ion-icon name="create-outline"></ion-icon>
                Edit Sakit
            </span>
        </a>
        @elseif($dataizin->status=="c")
        <a href="/izincuti/{{$dataizin->id }}/edit"  class="btn btn-list text-primary">
            <span>
                <ion-icon name="create-outline"></ion-icon>
                Edit Cuti
            </span>
        </a>
        @endif
    </li>
    
    <li>
        <a href="#" id="deletebutton" class="btn btn-list text-danger" data-dismiss="modal" data-toggle="modal" data-target="#DialogBasic">
            <span>
                <ion-icon name="trash-outline"></ion-icon>
                Delete
            </span>
        </a>
    </li>
</ul>
