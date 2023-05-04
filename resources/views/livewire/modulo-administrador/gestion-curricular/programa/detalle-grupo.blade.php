<div>
  <div class="row">
      <div class="col-sm-12">
          {{-- <div class="d-flex justify-content-end align-items-center mb-3">
              <a href="#modalCurso" type="button" wire:click="modo()" class="btn btn-primary btn-label waves-effect right waves-light w-md" data-bs-toggle="modal" data-bs-target="#modalGrupo"><i class="ri-user-add-line label-icon align-middle fs-16 ms-2"></i> Nuevo</a>
          </div> --}}
          <div class="card">
              <div class="card-body">
                  {{-- <div class="d-flex justify-content-between align-items-center mb-2">
                      <div class="d-flex justify-content-between align-items-center gap-4">
                          
                      </div>
                      <div class="w-25">
                          <input class="form-control text-muted" type="search" wire:model="search"
                              placeholder="Buscar...">
                      </div>
                  </div> --}}
                  <div class="table-responsive">
                      <table class="table table-hover align-middle table-nowrap mb-0">
                          <thead>
                              <tr align="center" style="background-color: rgb(179, 197, 245)">
                                  <th scope="col" class="col-md-1">ID</th>
                                  <th scope="col">Codigo Admitido</th>
                                  <th scope="col">Admitido</th>
                                  <th scope="col">DNI</th>
                                  <th scope="col">Grupo</th>
                                  <th scope="col">Fecha de Matricula</th>
                                  <th scope="col" class="col-md-1">Acciones</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($detalle_grupos as $item)
                              @php
                                  
                              @endphp
                              <tr>
                                  <td align="center"><strong>{{ $item->admitidos_id }}</strong></td>
                                  <td align="center">{{ $item->admitidos_codigo }}</td>
                                  <td align="center">{{ $item->nombre_completo }}</td>
                                  <td align="center">{{ $item->num_doc }}</td>
                                  <td align="center">{{ $item->grupo }}</td>
                                  <td align="center">{{ date('d/m/Y', strtotime($item->fecha_pago)) }}</td>
                                  <td align="center">
                                    <a href="#modalGrupo" wire:click="cargarEditar({{ $item->admitidos_id }})" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalGrupo">Editar</a>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @if ($detalle_grupos->count() == 0)
                          <div class="text-center p-3 text-muted">
                              <span>No hay resultados</span>
                          </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
  {{-- Modales --}}
  <div wire:ignore.self class="modal fade" id="modalGrupo" tabindex="-1" aria-labelledby="modalCurso"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Editar Grupo de Admitido</h5>
                  <button type="button" wire:click="limpiar()" class="btn-close" data-bs-dismiss="modal"
                      aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form novalidate>
                      <div class="row">
                          <div class="mb-3 col-md-12 col-sm-12">
                              <label class="form-label">Grupos <span
                                      class="text-danger">*</span></label>
                              <select wire:model="grupo" class="form-select @error('grupo') is-invalid  @enderror">
                                  <option value="">Seleccione su grupo</option>
                                  @foreach ($grupos as $item)
                                      <option value="{{ $item->id_grupo_programa }}">Grupo: {{ $item->grupo }}</option>
                                  @endforeach
                              </select>
                              @error('grupo') <span class="error text-danger" >{{ $message }}</span> @enderror
                          </div>
                          {{-- <div class="mb-3 col-md-6 col-sm-12">
                              <label class="form-label">Credito <span
                                  class="text-danger">*</span></label>
                              <input wire:model="credito" type="number" class="form-control @error('credito') is-invalid  @enderror" placeholder="Ingrese los creditos del curso">
                              @error('credito') <span class="error text-danger" >{{ $message }}</span> @enderror
                          </div>
                          <div class="mb-3 col-md-6 col-sm-12">
                              <label class="form-label">Horas <span
                                  class="text-danger">*</span></label>
                              <input wire:model="horas" type="number" class="form-control @error('horas') is-invalid  @enderror" placeholder="Ingrese las horas del curso">
                              @error('horas') <span class="error text-danger" >{{ $message }}</span> @enderror
                          </div> --}}
                      </div>
                  </form>
              </div>
              <div class="modal-footer col-12 d-flex justify-content-between">
                  <button type="button" wire:click="limpiar()" class="btn btn-secondary btn-label waves-effect waves-light w-md" data-bs-dismiss="modal"><i class="ri-arrow-left-s-line label-icon align-middle fs-16 me-2"></i> Cancelar</button>
                  <button type="button" wire:click="guardar()" class="btn btn-primary btn-label waves-effect right waves-light w-md"><i class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Guardar</button>
              </div>
          </div>
      </div>
  </div>
</div>