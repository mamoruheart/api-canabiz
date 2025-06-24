@component('mail::message')
    <div style="direction: rtl; text-align: right;">
        <h1 style="text-align: right">בעלי רישיון עיסוק בקנביס</h1>
        @if($newLH->count() > 0)
            <h3 style="text-align: right">חדש:</h3>
            <table align="center" width="100%" cellpadding="6" cellspacing="0" role="presentation" style="direction: rtl">
                <thead>
                <tr>
                    <th>שם</th>
                    <th>סוג עוסק</th>
                </tr>
                </thead>
                <tbody>
                @foreach($newLH as $new_pharm)
                    <tr>
                        <td style="color: darkgreen">{{$new_pharm->name}}</td>
                        <td style="color: darkgreen">{{$new_pharm->type}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
        @endif
        @if($removedLH->count() > 0)
            <h3 style="text-align: right">הוסר:</h3>
            <table align="center" width="100%" cellpadding="6" cellspacing="0" role="presentation" style="direction: rtl">
                <thead>
                <tr>
                    <th>שם</th>
                    <th>סוג עוסק</th>
                </tr>
                </thead>
                <tbody>
                @foreach($removedLH as $rem_pharm)
                    <tr>
                        <td style="color: darkred">{{$rem_pharm->name}}</td>
                        <td style="color: darkred">{{$rem_pharm->type}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endcomponent