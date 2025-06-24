@component('mail::message')
    <div style="direction: rtl; text-align: right;">
        <h1 style="text-align: right">בתי מרקחת המורשים למכור קנביס רפואי</h1>
        @if($newPharmacies->count() > 0)
            <h3 style="text-align: right">חדש:</h3>
            <table align="center" width="100%" cellpadding="6" cellspacing="0" role="presentation" style="direction: rtl">
                <thead>
                <tr>
                    <th>שם</th>
                    <th>עיר</th>
                    <th>רחוב</th>
                    <th>מפה</th>
                </tr>
                </thead>
                <tbody>
                @foreach($newPharmacies as $new_pharm)
                    <tr>
                        <td style="color: darkgreen">{{$new_pharm->name}}</td>
                        <td style="color: darkgreen">{{$new_pharm->city}}</td>
                        <td style="color: darkgreen">{{$new_pharm->street}}</td>
                        <td style="color: darkgreen">{!! $new_pharm->map !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
        @endif
        @if($removedPharmacies->count() > 0)
            <h3 style="text-align: right">הוסר:</h3>
            <table align="center" width="100%" cellpadding="6" cellspacing="0" role="presentation" style="direction: rtl">
                <thead>
                <tr>
                    <th>שם</th>
                    <th>עיר</th>
                    <th>רחוב</th>
                    <th>מפה</th>
                </tr>
                </thead>
                <tbody>
                @foreach($removedPharmacies as $rem_pharm)
                    <tr>
                        <td style="color: darkred">{{$rem_pharm->name}}</td>
                        <td style="color: darkred">{{$rem_pharm->city}}</td>
                        <td style="color: darkred">{{$rem_pharm->street}}</td>
                        <td style="color: darkred">{!! $rem_pharm->map !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endcomponent