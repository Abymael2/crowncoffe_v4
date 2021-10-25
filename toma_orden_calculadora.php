<!-- Modal -->
<div class="modal fade" id="modal_calc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-100" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Calculadora</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="calc bg-primary border border-secondary border-5 p-2">
                        <div class="result-bar bg-secondary col-md-12 p-3 text-center fs-3 fw-bold text-primary">
                            <span id="Result" class="p-3"></span>
                        </div>
                        <div class="text-left p-3">
                            <input type="button" class="operator-out btn btn-outline-danger fw-bold p-3" value="C" id="borrar">
                        </div>
                        <div class="controlls row row-cols-lg-4">
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="7" id="siete">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="8" id="ocho">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="9" id="nueve">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="/" id="div">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="4" id="cuatro">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="5" id="cinco">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="6" id="seis">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="*" id="milti">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="1" id="uno">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="2" id="dos">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="3" id="tres">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="-" id="menos">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="=" id="igual">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="0" id="cero">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="." id="punto">
                            </div>
                            <div class="col-3 text-center">
                                <input type="button" class="number btn btn-outline-secondary p-3" value="+" id="mas">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
            
        </div>
    </div>
</div>

