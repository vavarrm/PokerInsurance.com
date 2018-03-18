<main class="page-content"  ng-controller="orderCtrl" ng-init="orderList()">
	<!-- Breadcrumbs & Page title-->
	<{include file="Frontend/breadcrumbs.tpl"}>
	<section class="text-left section-50 section-sm-top-100 section-sm-bottom-100">
		<div class="shell">
			<!-- RD Search-->
			<!-- RD Search Form-->
			<form action="search-results.html" method="GET" class="form-search rd-search">
				<div class="form-group">
					<label for="blog-sidebar-2-form-search-widget" class="form-label form-search-label form-label-sm"><{$foodLanguageAry.order_o_id}></label>
					<input id="blog-sidebar-2-form-search-widget" type="text" name="s" autocomplete="off" class="form-search-input form-control "/>
				</div>
					<button type="submit" class="form-search-submit">
					<span class="mdi mdi-magnify"></span>
				</button>
            </form>
			<div class="toolbar-search bg-gray-lighter offset-top-40">
				<div class="toolbar-search-item">
					<div class="toolbar-search-inside"><span><{$foodLanguageAry.order_o_datetime}>:</span></div>
					<div class="toolbar-search-inside toolbar-search-icon toolbar-search-mod">
						<a href="#">
							<span class="icon-sm text-primary mdi mdi-sort-ascending"></span>
						</a>
					</div>
					<div class="toolbar-search-inside toolbar-search-icon border">
						<a href="#">
							<span class="icon-sm text-dark mdi mdi-sort-descending"></span>
						</a>
					</div>
				</div>
				<div class="toolbar-search-item">
					<div class="toolbar-search-inside"><span class="text-primary">1-4 of 15</span></div>
					<div class="toolbar-search-inside toolbar-search-mod">
						<div class="form-group text-dark toolbar-search-pager-select">
							<label>Show:</label>
							<select data-placeholder="Select an option" data-minimum-results-for-search="Infinity" class="form-control select-filter">
								<option value="5">5</option>
								<option value="10" selected >10</option>
								<option value="20">20</option>
								<option value="50">50</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="toolbar-search bg-gray-lighter offset-top-40">
				<div class="toolbar-search-item">
					<div class="toolbar-search-inside">
						<span><{$foodLanguageAry.order_o_status}>:</span>
					</div>
					<div>
						<div class="form-group toolbar-search-name-select">
							<select ng-model="data.o_status" data-placeholder="Select an option" data-minimum-results-for-search="Infinity" class="form-control select-filter">
								<{foreach from=$order_status item=row}>
								<option <{if $row.os_id =='1'}>selected<{/if}>  value="<{$row.os_id}>"><{$row.os_name}></option>
								<{/foreach}>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="rd-search-results offset-top-40 offset-sm-top-60">
				<div class="container">
					<div class="row text-sm-left">
						<div class="col-xs-12">
							<div class="table-responsive">
								<table class="table table-primary">
									<thead>
										<tr>
											<th><{$foodLanguageAry.order_o_id}></th>
											<th><{$foodLanguageAry.order_o_status}></th>
											<th><{$foodLanguageAry.order_o_total}></th>
										</tr>
									</thead>
									<tbody>
										<tr  ng-repeat="row in data.orders">
											<td>{{row.o_id}}</td>
											<td>{{row.os_name}}</td>
											<td>{{row.o_total}}</td>
										</tr>
									</tbody>
							  </table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="offset-top-40 text-center">
				<!-- Classic Pagination-->
				<nav>
				  <ul class="pagination-classic-variant-2">
					<li class="disabled"><span class="mdi mdi-chevron-double-left"></span></li>
					<li class="active"><span>1</span></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#" class="mdi mdi-chevron-double-right"></a></li>
				  </ul>
				</nav>
			</div>
		</div>
	</section>
</main>