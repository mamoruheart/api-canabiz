@component('mail::message')
    <div style="direction: rtl; text-align: right;">
        <h1 style="text-align: right">ריכזנו את המידע עבורכם</h1>
        @if($new_strips->count() > 0)
            <h3 style="text-align: right">מדיניות ונהלים:</h3>
            @foreach($new_strips as $new_strip)
                <div style="width: 100%; display: grid; background: #f0f6ff 0 0 no-repeat padding-box; border-radius: 6px; margin-bottom: 16px; padding: 16px; color: #083f6e; text-align: right;">
                    <a href="{{$new_strip->url}}" target="_blank">
                        <span style="font-size: 18px; font-weight: bold;">{{$new_strip->title}}</span>
                    </a>
                    <span style="font-size: 16px; font-weight: normal;">{{$new_strip->description}}</span>
                    <div style="display: inline-flex;">
                        <span style="font-size: 14px; font-weight: normal; color: rgba(12,48,88,.8); padding-left: 0.25rem;">{{$new_strip->date}}</span>
                        <span style="font-size: 14px; font-weight: normal; color: rgba(12,48,88,.8); padding-left: 0.25rem;">* {{$new_strip->type}}</span>
                    </div>
                </div>
            @endforeach
        @endif
        @if($new_ads->count() > 0)
            <h3 style="text-align: right">פרסומים:</h3>
            @foreach($new_ads as $strip)
                <div style="width: 100%; display: grid; background: #f0f6ff 0 0 no-repeat padding-box; border-radius: 6px; margin-bottom: 16px; padding: 16px; color: #083f6e; text-align: right;">
                    <a href="{{$strip->url}}" target="_blank">
                        <span style="font-size: 18px; font-weight: bold;">{{$strip->title}}</span>
                    </a>
                    <span style="font-size: 16px; font-weight: normal;">{{$strip->description}}</span>
                    <div style="display: inline-flex;">
                        <span style="font-size: 14px; font-weight: normal; color: rgba(12,48,88,.8); padding-left: 0.25rem;">{{$strip->date}}</span>
                        <span style="font-size: 14px; font-weight: normal; color: rgba(12,48,88,.8); padding-left: 0.25rem;">* {{$strip->type}}</span>
                    </div>
                </div>
            @endforeach
        @endif
        @if($alerts->count() > 0)
            <h3 style="text-align: right">Alerts:</h3>
            @foreach($alerts as $strip)
                <div style="width: 100%; display: grid; background: #f0f6ff 0 0 no-repeat padding-box; border-radius: 6px; margin-bottom: 16px; padding: 16px; color: #083f6e; text-align: right;">
                    <a href="{{$strip->url}}" target="_blank">
                        <span style="font-size: 18px; font-weight: bold;">{{$strip->title}}</span>
                    </a>
                    <div style="display: inline-flex;">
                        <span style="font-size: 14px; font-weight: normal; color: rgba(12,48,88,.8); padding-left: 0.25rem;">{{$strip->date}}</span>
                    </div>
                </div>
            @endforeach
        @endif
        @if($news->count() > 0)
            <h3 style="text-align: right">הודעות דובר:</h3>
            @foreach($news as $strip)
                <div style="width: 100%; display: grid; background: #f0f6ff 0 0 no-repeat padding-box; border-radius: 6px; margin-bottom: 16px; padding: 16px; color: #083f6e; text-align: right;">
                    <a href="{{$strip->url}}" target="_blank">
                        <span style="font-size: 18px; font-weight: bold;">{{$strip->title}}</span>
                    </a>
                    <span style="font-size: 16px; font-weight: normal;">{{$strip->description}}</span>
                    <div style="display: inline-flex;">
                        <span style="font-size: 14px; font-weight: normal; color: rgba(12,48,88,.8); padding-left: 0.25rem;">{{$strip->date}}</span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endcomponent