<div>
    <form wire:submit.prevent="register">
        <div class="form-group">
            <label>نام و نام خانوادگی</label>
            <div class="input-with-icon">
                <input type="text" wire:model="name" class="form-control">
                <i class="ti-user"></i>
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>آدرس ایمیل *</label>
            <div class="input-with-icon">
                <input type="email" wire:model="email" class="form-control">
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
            <label>تکرار کلمه عبور *</label>
            <div class="input-with-icon">
                <input type="password" wire:model="password_confirmation" class="form-control">
                <i class="ti-unlock"></i>
            </div>
        </div>

        <div class="form-group">
            <input type="checkbox" wire:model="terms"> با استفاده از وب سایت، شرایط و ضوابط را می‌پذیرم
        </div>

        <button type="submit" class="btn btn-success">ثبت نام</button>
    </form>
</div>
