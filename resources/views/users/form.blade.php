@csrf
<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>NIK</label>
    <input type="text" name="nik" class="form-control" value="{{ old('nik', $user->nik ?? '') }}" required>
</div>
<div class="mb-3">
    <label>TPS</label>
    <select name="tps_id" class="form-control">
        @foreach($tpsList as $tps)
            <option value="{{ $tps->id }}" {{ (old('tps_id', $user->tps_id ?? '') == $tps->id) ? 'selected' : '' }}>
                {{ $tps->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Role</label>
    <select name="role" class="form-control">
        <option value="voter" {{ (old('role', $user->role ?? '') == 'voter') ? 'selected' : '' }}>Voter</option>
        <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
    </select>
</div>
@if (!isset($user))
<div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
</div>
@endif
