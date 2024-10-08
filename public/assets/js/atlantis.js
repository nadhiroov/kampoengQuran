"use strict";
function layoutsColors() {
  $(".sidebar").is("[data-background-color]")
    ? $("html").addClass("sidebar-color")
    : $("html").removeClass("sidebar-color");
}
function customBackgroundColor() {
  $('*[data-background-color="custom"]').each(function () {
    $(this).is("[custom-color]")
      ? $(this).css("background", $(this).attr("custom-color"))
      : $(this).is("[custom-background]") &&
        $(this).css(
          "background-image",
          "url(" + $(this).attr("custom-background") + ")"
        );
  });
}
function legendClickCallback(s) {
  for (
    var a = (s = s || window.event).target || s.srcElement;
    "LI" !== a.nodeName;

  )
    a = a.parentElement;
  var e = a.parentElement,
    o = parseInt(e.classList[0].split("-")[0], 10),
    i = Chart.instances[o],
    n = Array.prototype.slice.call(e.children).indexOf(a);
  i.legend.options.onClick.call(i, s, i.legend.legendItems[n]),
    i.isDatasetVisible(n)
      ? a.classList.remove("hidden")
      : a.classList.add("hidden");
}
function readURL(s) {
  if (s.files && s.files[0]) {
    var a = new FileReader();
    (a.onload = function (a) {
      $(s)
        .parent(".input-file-image")
        .find(".img-upload-preview")
        .attr("src", a.target.result);
    }),
      a.readAsDataURL(s.files[0]);
  }
}
function showPassword(s) {
  var a = $(s).parent().find("input");
  "password" === a.attr("type")
    ? a.attr("type", "text")
    : a.attr("type", "password");
}
function changeContainer() {
  1 == showSignIn
    ? containerSignIn.css("display", "block")
    : containerSignIn.css("display", "none"),
    1 == showSignUp
      ? containerSignUp.css("display", "block")
      : containerSignUp.css("display", "none");
}
$(".nav-search .input-group > input")
  .focus(function (s) {
    $(this).parents().eq(2).addClass("focus");
  })
  .blur(function (s) {
    $(this).parents().eq(2).removeClass("focus");
  }),
  $(function () {
    $('[data-toggle="tooltip"]').tooltip(),
      $('[data-toggle="popover"]').popover(),
      layoutsColors(),
      customBackgroundColor();
  }),
  $(document).ready(function () {
    $(".btn-refresh-card").on("click", function () {
      var s = $(this).parents(".card");
      s.length &&
        (s.addClass("is-loading"),
        setTimeout(function () {
          s.removeClass("is-loading");
        }, 3e3));
    });
    var s = $(".sidebar .scrollbar");
    s.length > 0 && s.scrollbar();
    var a = $(".main-panel .content-scroll");
    a.length > 0 && a.scrollbar();
    var e = $(".messages-scroll");
    e.length > 0 && e.scrollbar();
    var o = $(".tasks-scroll");
    o.length > 0 && o.scrollbar();
    var i = $(".quick-scroll");
    i.length > 0 && i.scrollbar();
    var n = $(".message-notif-scroll");
    n.length > 0 && n.scrollbar();
    var r = $(".notif-scroll");
    r.length > 0 && r.scrollbar();
    var l = $(".quick-actions-scroll");
    l.length > 0 && l.scrollbar();
    var t = $(".dropdown-user-scroll");
    t.length > 0 && t.scrollbar(),
      $(".scroll-bar").draggable(),
      $("#search-nav").on("shown.bs.collapse", function () {
        $(".nav-search .form-control").focus();
      });
    var c = !1,
      d = !1,
      g = !1,
      p = !1,
      u = 0,
      h = 0,
      m = 0,
      v = 0,
      f = 0,
      b = 0;
    if (!c) {
      (C = $(".sidenav-toggler")).on("click", function () {
        1 == u
          ? ($("html").removeClass("nav_open"),
            C.removeClass("toggled"),
            (u = 0))
          : ($("html").addClass("nav_open"), C.addClass("toggled"), (u = 1));
      }),
        (c = !0);
    }
    if (!h) {
      var C = $(".quick-sidebar-toggler");
      C.on("click", function () {
        1 == u
          ? ($("html").removeClass("quick_sidebar_open"),
            $(".quick-sidebar-overlay").remove(),
            C.removeClass("toggled"),
            (h = 0))
          : ($("html").addClass("quick_sidebar_open"),
            C.addClass("toggled"),
            $('<div class="quick-sidebar-overlay"></div>').insertAfter(
              ".quick-sidebar"
            ),
            (h = 1));
      }),
        $(".wrapper").mouseup(function (s) {
          var a = $(".quick-sidebar");
          s.target.className == a.attr("class") ||
            a.has(s.target).length ||
            ($("html").removeClass("quick_sidebar_open"),
            $(".quick-sidebar-toggler").removeClass("toggled"),
            $(".quick-sidebar-overlay").remove(),
            (h = 0));
        }),
        $(".close-quick-sidebar").on("click", function () {
          $("html").removeClass("quick_sidebar_open"),
            $(".quick-sidebar-toggler").removeClass("toggled"),
            $(".quick-sidebar-overlay").remove(),
            (h = 0);
        }),
        (h = !0);
    }
    if (!d) {
      var k = $(".topbar-toggler");
      k.on("click", function () {
        1 == m
          ? ($("html").removeClass("topbar_open"),
            k.removeClass("toggled"),
            (m = 0))
          : ($("html").addClass("topbar_open"), k.addClass("toggled"), (m = 1));
      }),
        (d = !0);
    }
    if (!g) {
      var w = $(".toggle-sidebar");
      $(".wrapper").hasClass("sidebar_minimize") &&
        ((v = 1),
        w.addClass("toggled"),
        w.html('<i class="icon-options-vertical"></i>')),
        w.on("click", function () {
          1 == v
            ? ($(".wrapper").removeClass("sidebar_minimize"),
              w.removeClass("toggled"),
              w.html('<i class="icon-menu"></i>'),
              (v = 0))
            : ($(".wrapper").addClass("sidebar_minimize"),
              w.addClass("toggled"),
              w.html('<i class="icon-options-vertical"></i>'),
              (v = 1)),
            $(window).resize();
        }),
        (g = !0);
    }
    if (!p) {
      var _ = $(".page-sidebar-toggler");
      _.on("click", function () {
        1 == f
          ? ($("html").removeClass("pagesidebar_open"),
            _.removeClass("toggled"),
            (f = 0))
          : ($("html").addClass("pagesidebar_open"),
            _.addClass("toggled"),
            (f = 1));
      });
      $(".page-sidebar .back").on("click", function () {
        $("html").removeClass("pagesidebar_open"),
          _.removeClass("toggled"),
          (f = 0);
      }),
        (p = !0);
    }
    var y = $(".sidenav-overlay-toggler");
    $(".wrapper").hasClass("is-show") &&
      ((b = 1),
      y.addClass("toggled"),
      y.html('<i class="icon-options-vertical"></i>')),
      y.on("click", function () {
        1 == b
          ? ($(".wrapper").removeClass("is-show"),
            y.removeClass("toggled"),
            y.html('<i class="icon-menu"></i>'),
            (b = 0))
          : ($(".wrapper").addClass("is-show"),
            y.addClass("toggled"),
            y.html('<i class="icon-options-vertical"></i>'),
            (b = 1)),
          $(window).resize();
      }),
      (g = !0),
      $(".sidebar").hover(
        function () {
          $(".wrapper").hasClass("sidebar_minimize") &&
            $(".wrapper").addClass("sidebar_minimize_hover");
        },
        function () {
          $(".wrapper").hasClass("sidebar_minimize") &&
            $(".wrapper").removeClass("sidebar_minimize_hover");
        }
      ),
      $(".nav-item a").on("click", function () {
        $(this).parent().find(".collapse").hasClass("show")
          ? $(this).parent().removeClass("submenu")
          : $(this).parent().addClass("submenu");
      }),
      $(".messages-contact .user a").on("click", function () {
        $(".tab-chat").addClass("show-chat");
      }),
      $(".messages-wrapper .return").on("click", function () {
        $(".tab-chat").removeClass("show-chat");
      }),
      $('[data-select="checkbox"]').change(function () {
        var s = $(this).attr("data-target");
        $(s).prop("checked", $(this).prop("checked"));
      }),
      $(".form-group-default .form-control")
        .focus(function () {
          $(this).parent().addClass("active");
        })
        .blur(function () {
          $(this).parent().removeClass("active");
        });
  }),
  $('.input-file-image input[type="file"').change(function () {
    readURL(this);
  }),
  $(".show-password").on("click", function () {
    showPassword(this);
  });
var containerSignIn = $(".container-login"),
  containerSignUp = $(".container-signup"),
  showSignIn = !0,
  showSignUp = !1;
$("#show-signup").on("click", function () {
  (showSignUp = !0), (showSignIn = !1), changeContainer();
}),
  $("#show-signin").on("click", function () {
    (showSignUp = !1), (showSignIn = !0), changeContainer();
  }),
  changeContainer(),
  $(".form-floating-label .form-control").keyup(function () {
    "" !== $(this).val()
      ? $(this).addClass("filled")
      : $(this).removeClass("filled");
  });
