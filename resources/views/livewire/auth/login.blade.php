<div>
    <form wire:submit.prevent="login">
        <div class="form-group">
            <label>نام کاربری یا آدرس ایمیل *</label>
            <div class="input-with-icon">
                <input type="text" wire:model="email" class="form-control">
                <i class="ti-user"></i>
            </div>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>کلمه عبور *</label>
            <div class="input-with-icon">
                <input type="password" wire:model="password" class="form-control">
                <i class="ti-unlock"></i>
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <input type="checkbox" wire:model="remember"> مرا به خاطر بسپار
            <a href="/forget_password" style="font-size: 13px ; float: left;" wire:navigate>کلمه
                عبور خود را
                فراموش کرده
                اید؟</a>
        </div>
        <button type="submit" class="btn btn-primary">ورود</button>
    </form>
</div>
