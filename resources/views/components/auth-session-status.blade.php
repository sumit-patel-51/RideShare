@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert-pop']) }} 
         style="background-color: #FF9F43; 
                border: 3px solid #000; 
                padding: 15px 20px; 
                box-shadow: 6px 6px 0px 0px rgba(0,0,0,1); 
                border-radius: 12px; 
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                gap: 12px;">
        
        <span style="font-size: 1.2rem;">⚡</span>
        
        <div style="font-weight: 800; color: #000; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px;">
            {{ $status }}
        </div>
    </div>
@endif