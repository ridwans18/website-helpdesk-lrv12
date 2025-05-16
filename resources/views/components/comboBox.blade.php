import { Combobox, ComboboxLabel, ComboboxOption } from '@/components/combobox'
import { Field, Label } from '@/components/fieldset'

function Example({ currentUser, users }) {
  return (
    <Field>
      <Label>Assigned to</Label>
      <Combobox name="user" options={users} displayValue={(user) => user?.name} defaultValue={currentUser}>
        {(user) => (
          <ComboboxOption value={user}>
            <ComboboxLabel>{user.name}</ComboboxLabel>
          </ComboboxOption>
        )}
      </Combobox>
    </Field>
  )
}

<div>
    <label for="user" class="block font-medium">Assigned to</label>
    <select name="user" id="user" class="w-full border border-gray-300 rounded px-3 py-2">
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ $user->id == $currentUser->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>