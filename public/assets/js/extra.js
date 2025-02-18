document.getElementById('addMaterial').addEventListener('click', function () {
    let container = document.getElementById("materialsContainer");
    let index = container.children.length;

    let materialRow = document.createElement('div');
    materialRow.classList.add('d-flex', 'gap-2', 'mb-2');

    materialRow.innerHTML = `
        <select name="materials[${index}][id]" class="form-control" required>
            <option value="">Material tanlang</option>
            @foreach ($materials as $material)
                <option value="{{ $material->id }}">{{ $material->name }}</option>
            @endforeach
        </select>
        <input type="number" name="materials[${index}][quantity]" class="form-control" placeholder="Miqdor" min="1" required>
        <button type="button" class="btn btn-danger btn-round removeMaterial">O'chirish</button>
    `;

    container.appendChild(materialRow);
});

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('removeMaterial')) {
        event.target.closest('div').remove();
    }
});

document.querySelectorAll('.group-checkbox').forEach(groupCheckbox => {
    groupCheckbox.addEventListener('change', function () {
        const groupId = this.dataset.group;
        document.querySelectorAll(`.permission-checkbox[data-group="${groupId}"]`)
            .forEach(permissionCheckbox => {
                permissionCheckbox.checked = this.checked;
            });
    });
});