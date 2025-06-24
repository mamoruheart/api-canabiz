@component('mail::message')
    <div style="direction: rtl; text-align: right;">
        <h1 style="text-align: right">רופאים המוסמכים להנפיק רישיון לקנביס רפואי</h1>
        @if($newPhysicians->count() > 0)
            <h3 style="text-align: right">חדש:</h3>
            <table align="center" width="100%" cellpadding="6" cellspacing="0" role="presentation" style="direction: rtl">
                <thead>
                <tr>
                    <th>שם</th>
                    <th>עיר</th>
                    <th>רחוב</th>
                    <th>מומחיות</th>
                </tr>
                </thead>
                <tbody>
                @foreach($newPhysicians as $new_pharm)
                    <tr>
                        <td style="color: darkgreen">{{$new_pharm->name}}</td>
                        <td style="color: darkgreen">{{$new_pharm->city}}</td>
                        <td style="color: darkgreen">{{$new_pharm->street}}</td>
                        <td style="color: darkgreen">{{ $new_pharm->specialty }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
        @endif
        @if($removedPhysicians->count() > 0)
            <h3 style="text-align: right">הוסר:</h3>
            <table align="center" width="100%" cellpadding="6" cellspacing="0" role="presentation" style="direction: rtl">
                <thead>
                <tr>
                    <th>שם</th>
                    <th>עיר</th>
                    <th>רחוב</th>
                    <th>מומחיות</th>
                </tr>
                </thead>
                <tbody>
                @foreach($removedPhysicians as $rem_pharm)
                    <tr>
                        <td style="color: darkred">{{$rem_pharm->name}}</td>
                        <td style="color: darkred">{{$rem_pharm->city}}</td>
                        <td style="color: darkred">{{$rem_pharm->street}}</td>
                        <td style="color: darkred">{{ $rem_pharm->specialty }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endcomponent