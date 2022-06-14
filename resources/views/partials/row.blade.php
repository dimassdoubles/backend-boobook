<tr>
    <td>
      <div class=" px-2 py-1">
        {{-- <div>
          <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
        </div> --}}
        <div class="d-flex flex-column justify-content-center">
          <h6 class="mb-0 text-sm">{{ $book_id }}</h6>
          {{-- <p class="text-xs text-secondary mb-0">{john@creative-tim.com}</p> --}}
        </div>
      </div>
    </td>
    <td>
      <p class="text-xs font-weight-bold mb-0">{{ $title }}</p>
      {{-- <p class="text-xs text-secondary mb-0">Organization</p> --}}
    </td>
    <td class="align-middle text-center text-sm">
      <span class="text-secondary text-xs font-weight-bold">{{ $author }}</span>
    </td>
    <td class="align-middle text-center">
      <span class="text-secondary text-xs font-weight-bold">{{ $year }}</span>
    </td>
    <td class="align-middle">
      <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
        Edit
      </a>
    </td>
  </tr>