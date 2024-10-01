@extends('layouts.sidebar')
@section('main')
     <div class="card border-0 shadow mb-4" style="width: 65rem;">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4">
              <img src="{{ asset('images/LOGO.png') }}" alt="Welancer">
              <span class="title-welancer ms-3">Freelancer</span>
              <a href="{{ route('create-pegawai') }}" class="button-create ms-auto py-2 px-3 bd-highlight">Create</a>
          </div>
            <table class="table table-borderless border-0" id="dataTable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Skill</th>
                <th scope="col">Level</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($pegawaiSkills as $pegawaiSkill)
                    <tr>
                        <th scope="row">{{ $loop->index+1 }}</th>
                        <td>{{ $pegawaiSkill->skills->nama }}</td>
                        <td>{{ $pegawaiSkill->level }}</td>
                        {{-- @foreach ($pegawai->skills as $skill)
                            <td>{{ $skill->nama }}</td>
                            <td>{{ $skill->pivot->level }}</td>
                        @endforeach --}}
                        <td>
                            <div class="flex gap-2">
                                <button class="button-edit" data-modal-toggle="update-modal-{{ $pegawaiSkill->id }}" data-modal-target="update-modal-{{ $pegawaiSkill->id }}"><i class="fas fa-pencil-alt"></i></button>
                                <button class="button-delete"><i class="fas fa-times" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $pegawaiSkill->id }}"></i></button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
@endsection
