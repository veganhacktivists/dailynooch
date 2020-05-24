﻿/*
 Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
*/
;(function() {
  function v() {
    return !1
  }
  function z(a, b) {
    var c,
      d = []
    a.filterChildren(b)
    for (c = a.children.length - 1; 0 <= c; c--)
      d.unshift(a.children[c]), a.children[c].remove()
    c = a.attributes
    var e = a,
      f = !0,
      g
    for (g in c)
      if (f) f = !1
      else {
        var q = new CKEDITOR.htmlParser.element(a.name)
        q.attributes[g] = c[g]
        e.add(q)
        e = q
        delete c[g]
      }
    for (c = 0; c < d.length; c++) e.add(d[c])
  }
  function x(a) {
    var b = a.margin ? 'margin' : a.MARGIN ? 'MARGIN' : !1,
      c,
      d
    if (b) {
      d = CKEDITOR.tools.style.parse.margin(a[b])
      for (c in d) a['margin-' + c] = d[c]
      delete a[b]
    }
  }
  var h,
    k,
    r,
    p,
    m = CKEDITOR.tools,
    A = ['o:p', 'xml', 'script', 'meta', 'link'],
    B = 'v:arc v:curve v:line v:oval v:polyline v:rect v:roundrect v:group'.split(
      ' ',
    ),
    y = {},
    w = 0
  CKEDITOR.plugins.pastefromword = {}
  CKEDITOR.cleanWord = function(a, b) {
    function c(a) {
      ;(a.attributes['o:gfxdata'] || 'v:group' === a.parent.name) &&
        e.push(a.attributes.id)
    }
    var d = Boolean(a.match(/mso-list:\s*l\d+\s+level\d+\s+lfo\d+/)),
      e = []
    CKEDITOR.plugins.clipboard.isCustomDataTypesSupported &&
      (a = CKEDITOR.plugins.pastefromword.styles.inliner
        .inline(a)
        .getBody()
        .getHtml())
    a = a.replace(/<!\[/g, '\x3c!--[').replace(/\]>/g, ']--\x3e')
    var f = CKEDITOR.htmlParser.fragment.fromHtml(a),
      g = {
        root: function(a) {
          a.filterChildren(p)
          CKEDITOR.plugins.pastefromword.lists.cleanup(h.createLists(a))
        },
        elementNames: [
          [/^\?xml:namespace$/, ''],
          [/^v:shapetype/, ''],
          [new RegExp(A.join('|')), ''],
        ],
        elements: {
          a: function(a) {
            if (a.attributes.name) {
              if ('_GoBack' == a.attributes.name) {
                delete a.name
                return
              }
              if (a.attributes.name.match(/^OLE_LINK\d+$/)) {
                delete a.name
                return
              }
            }
            if (a.attributes.href && a.attributes.href.match(/#.+$/)) {
              var b = a.attributes.href.match(/#(.+)$/)[1]
              y[b] = a
            }
            a.attributes.name &&
              y[a.attributes.name] &&
              ((a = y[a.attributes.name]),
              (a.attributes.href = a.attributes.href.replace(
                /.*#(.*)$/,
                '#$1',
              )))
          },
          div: function(a) {
            if (b.plugins.pagebreak && a.attributes['data-cke-pagebreak'])
              return a
            k.createStyleStack(a, p, b)
          },
          img: function(a) {
            if (a.parent && a.parent.attributes) {
              var b = a.parent.attributes
              ;(b = b.style || b.STYLE) &&
                b.match(/mso\-list:\s?Ignore/) &&
                (a.attributes['cke-ignored'] = !0)
            }
            k.mapCommonStyles(a)
            a.attributes.src &&
              a.attributes.src.match(/^file:\/\//) &&
              a.attributes.alt &&
              a.attributes.alt.match(/^https?:\/\//) &&
              (a.attributes.src = a.attributes.alt)
            a = a.attributes['v:shapes']
              ? a.attributes['v:shapes'].split(' ')
              : []
            b = CKEDITOR.tools.array.every(a, function(a) {
              return -1 < e.indexOf(a)
            })
            if (a.length && b) return !1
          },
          p: function(a) {
            a.filterChildren(p)
            if (
              a.attributes.style &&
              a.attributes.style.match(/display:\s*none/i)
            )
              return !1
            if (h.thisIsAListItem(b, a))
              r.isEdgeListItem(b, a) && r.cleanupEdgeListItem(a),
                h.convertToFakeListItem(b, a),
                m.array.reduce(
                  a.children,
                  function(a, b) {
                    'p' === b.name &&
                      (0 < a &&
                        new CKEDITOR.htmlParser.element('br').insertBefore(b),
                      b.replaceWithChildren(),
                      (a += 1))
                    return a
                  },
                  0,
                )
            else {
              var c = a.getAscendant(function(a) {
                  return 'ul' == a.name || 'ol' == a.name
                }),
                e = m.parseCssText(a.attributes.style)
              c &&
                !c.attributes['cke-list-level'] &&
                e['mso-list'] &&
                e['mso-list'].match(/level/) &&
                (c.attributes['cke-list-level'] = e['mso-list'].match(
                  /level(\d+)/,
                )[1])
              b.config.enterMode == CKEDITOR.ENTER_BR &&
                (delete a.name, a.add(new CKEDITOR.htmlParser.element('br')))
            }
            k.createStyleStack(a, p, b)
          },
          pre: function(a) {
            h.thisIsAListItem(b, a) && h.convertToFakeListItem(b, a)
            k.createStyleStack(a, p, b)
          },
          h1: function(a) {
            h.thisIsAListItem(b, a) && h.convertToFakeListItem(b, a)
            k.createStyleStack(a, p, b)
          },
          h2: function(a) {
            h.thisIsAListItem(b, a) && h.convertToFakeListItem(b, a)
            k.createStyleStack(a, p, b)
          },
          h3: function(a) {
            h.thisIsAListItem(b, a) && h.convertToFakeListItem(b, a)
            k.createStyleStack(a, p, b)
          },
          h4: function(a) {
            h.thisIsAListItem(b, a) && h.convertToFakeListItem(b, a)
            k.createStyleStack(a, p, b)
          },
          h5: function(a) {
            h.thisIsAListItem(b, a) && h.convertToFakeListItem(b, a)
            k.createStyleStack(a, p, b)
          },
          h6: function(a) {
            h.thisIsAListItem(b, a) && h.convertToFakeListItem(b, a)
            k.createStyleStack(a, p, b)
          },
          font: function(a) {
            if (a.getHtml().match(/^\s*$/))
              return new CKEDITOR.htmlParser.text(' ').insertAfter(a), !1
            b &&
              !0 === b.config.pasteFromWordRemoveFontStyles &&
              a.attributes.size &&
              delete a.attributes.size
            CKEDITOR.dtd.tr[a.parent.name] &&
            CKEDITOR.tools.arrayCompare(
              CKEDITOR.tools.object.keys(a.attributes),
              ['class', 'style'],
            )
              ? k.createStyleStack(a, p, b)
              : z(a, p)
          },
          ul: function(a) {
            if (d)
              return (
                'li' == a.parent.name &&
                  0 === m.indexOf(a.parent.children, a) &&
                  k.setStyle(a.parent, 'list-style-type', 'none'),
                h.dissolveList(a),
                !1
              )
          },
          li: function(a) {
            r.correctLevelShift(a)
            d &&
              ((a.attributes.style = k.normalizedStyles(a, b)),
              k.pushStylesLower(a))
          },
          ol: function(a) {
            if (d)
              return (
                'li' == a.parent.name &&
                  0 === m.indexOf(a.parent.children, a) &&
                  k.setStyle(a.parent, 'list-style-type', 'none'),
                h.dissolveList(a),
                !1
              )
          },
          span: function(a) {
            a.filterChildren(p)
            a.attributes.style = k.normalizedStyles(a, b)
            if (
              !a.attributes.style ||
              a.attributes.style.match(/^mso\-bookmark:OLE_LINK\d+$/) ||
              a.getHtml().match(/^(\s|&nbsp;)+$/)
            ) {
              for (var c = a.children.length - 1; 0 <= c; c--)
                a.children[c].insertAfter(a)
              return !1
            }
            a.attributes.style.match(/FONT-FAMILY:\s*Symbol/i) &&
              a.forEach(
                function(a) {
                  a.value = a.value.replace(/&nbsp;/g, '')
                },
                CKEDITOR.NODE_TEXT,
                !0,
              )
            k.createStyleStack(a, p, b)
          },
          table: function(a) {
            a.filterChildren(p)
            var b = a.parent,
              c = b && b.parent,
              e,
              d
            if (
              b.name &&
              'div' === b.name &&
              b.attributes.align &&
              1 === m.object.keys(b.attributes).length &&
              1 === b.children.length
            ) {
              a.attributes.align = b.attributes.align
              e = b.children.splice(0)
              a.remove()
              for (d = e.length - 1; 0 <= d; d--) c.add(e[d], b.getIndex())
              b.remove()
            }
            k.convertStyleToPx(a)
          },
          tr: function(a) {
            a.attributes = {}
          },
          td: function(a) {
            var c = a.getAscendant('table'),
              c = m.parseCssText(c.attributes.style, !0),
              e = c.background
            e && k.setStyle(a, 'background', e, !0)
            ;(c = c['background-color']) &&
              k.setStyle(a, 'background-color', c, !0)
            var c = m.parseCssText(a.attributes.style, !0),
              e = c.border
                ? CKEDITOR.tools.style.border.fromCssRule(c.border)
                : {},
              e = m.style.border.splitCssValues(c, e),
              d = CKEDITOR.tools.clone(c),
              f
            for (f in d) 0 == f.indexOf('border') && delete d[f]
            a.attributes.style = CKEDITOR.tools.writeCssText(d)
            c.background &&
              ((f = CKEDITOR.tools.style.parse.background(c.background)),
              f.color &&
                (k.setStyle(a, 'background-color', f.color, !0),
                k.setStyle(a, 'background', '')))
            for (var g in e)
              (f = c[g] ? CKEDITOR.tools.style.border.fromCssRule(c[g]) : e[g]),
                'none' === f.style
                  ? k.setStyle(a, g, 'none')
                  : k.setStyle(a, g, f.toString())
            k.mapCommonStyles(a)
            k.convertStyleToPx(a)
            k.createStyleStack(
              a,
              p,
              b,
              /margin|text\-align|padding|list\-style\-type|width|height|border|white\-space|vertical\-align|background/i,
            )
          },
          'v:imagedata': v,
          'v:shape': function(a) {
            var b = !1
            if (null === a.getFirst('v:imagedata')) c(a)
            else {
              a.parent.find(function(c) {
                'img' == c.name &&
                  c.attributes &&
                  c.attributes['v:shapes'] == a.attributes.id &&
                  (b = !0)
              }, !0)
              if (b) return !1
              var e = ''
              'v:group' === a.parent.name
                ? c(a)
                : (a.forEach(
                    function(a) {
                      a.attributes && a.attributes.src && (e = a.attributes.src)
                    },
                    CKEDITOR.NODE_ELEMENT,
                    !0,
                  ),
                  a.filterChildren(p),
                  (a.name = 'img'),
                  (a.attributes.src = a.attributes.src || e),
                  delete a.attributes.type)
            }
          },
          style: function() {
            return !1
          },
          object: function(a) {
            return !(!a.attributes || !a.attributes.data)
          },
          br: function(a) {
            if (
              b.plugins.pagebreak &&
              ((a = m.parseCssText(a.attributes.style, !0)),
              'always' === a['page-break-before'] ||
                'page' === a['break-before'])
            )
              return (
                (a = CKEDITOR.plugins.pagebreak.createElement(b)),
                CKEDITOR.htmlParser.fragment.fromHtml(a.getOuterHtml())
                  .children[0]
              )
          },
        },
        attributes: {
          style: function(a, c) {
            return k.normalizedStyles(c, b) || !1
          },
          class: function(a) {
            a = a.replace(
              /(el\d+)|(font\d+)|msonormal|msolistparagraph\w*/gi,
              '',
            )
            return '' === a ? !1 : a
          },
          cellspacing: v,
          cellpadding: v,
          border: v,
          'v:shapes': v,
          'o:spid': v,
        },
        comment: function(a) {
          a.match(/\[if.* supportFields.*\]/) && w++
          '[endif]' == a && (w = 0 < w ? w - 1 : 0)
          return !1
        },
        text: function(a, b) {
          if (w) return ''
          var c = b.parent && b.parent.parent
          return c &&
            c.attributes &&
            c.attributes.style &&
            c.attributes.style.match(/mso-list:\s*ignore/i)
            ? a.replace(/&nbsp;/g, ' ')
            : a
        },
      }
    CKEDITOR.tools.array.forEach(B, function(a) {
      g.elements[a] = c
    })
    p = new CKEDITOR.htmlParser.filter(g)
    var q = new CKEDITOR.htmlParser.basicWriter()
    p.applyTo(f)
    f.writeHtml(q)
    return q.getHtml()
  }
  CKEDITOR.plugins.pastefromword.styles = {
    setStyle: function(a, b, c, d) {
      var e = m.parseCssText(a.attributes.style)
      ;(d && e[b]) ||
        ('' === c ? delete e[b] : (e[b] = c),
        (a.attributes.style = CKEDITOR.tools.writeCssText(e)))
    },
    convertStyleToPx: function(a) {
      var b = a.attributes.style
      b &&
        (a.attributes.style = b.replace(/\d+(\.\d+)?pt/g, function(a) {
          return CKEDITOR.tools.convertToPx(a) + 'px'
        }))
    },
    mapStyles: function(a, b) {
      for (var c in b)
        if (a.attributes[c]) {
          if ('function' === typeof b[c]) b[c](a.attributes[c])
          else k.setStyle(a, b[c], a.attributes[c])
          delete a.attributes[c]
        }
    },
    mapCommonStyles: function(a) {
      return k.mapStyles(a, {
        vAlign: function(b) {
          k.setStyle(a, 'vertical-align', b)
        },
        width: function(b) {
          k.setStyle(a, 'width', b + 'px')
        },
        height: function(b) {
          k.setStyle(a, 'height', b + 'px')
        },
      })
    },
    normalizedStyles: function(a, b) {
      var c = 'background-color:transparent border-image:none color:windowtext direction:ltr mso- visibility:visible div:border:none'.split(
          ' ',
        ),
        d = 'font-family font font-size color background-color line-height text-decoration'.split(
          ' ',
        ),
        e = function() {
          for (var a = [], b = 0; b < arguments.length; b++)
            arguments[b] && a.push(arguments[b])
          return -1 !== m.indexOf(c, a.join(':'))
        },
        f = b && !0 === b.config.pasteFromWordRemoveFontStyles,
        g = m.parseCssText(a.attributes.style)
      'cke:li' == a.name &&
        (g['TEXT-INDENT'] && g.MARGIN
          ? ((a.attributes['cke-indentation'] = h.getElementIndentation(a)),
            (g.MARGIN = g.MARGIN.replace(
              /(([\w\.]+ ){3,3})[\d\.]+(\w+$)/,
              '$10$3',
            )))
          : delete g['TEXT-INDENT'],
        delete g['text-indent'])
      for (var q = m.object.keys(g), l = 0; l < q.length; l++) {
        var n = q[l].toLowerCase(),
          t = g[q[l]],
          k = CKEDITOR.tools.indexOf
        ;((f && -1 !== k(d, n.toLowerCase())) ||
          e(null, n, t) ||
          e(null, n.replace(/\-.*$/, '-')) ||
          e(null, n) ||
          e(a.name, n, t) ||
          e(a.name, n.replace(/\-.*$/, '-')) ||
          e(a.name, n) ||
          e(t)) &&
          delete g[q[l]]
      }
      var u = b && b.config.pasteFromWord_keepZeroMargins
      x(g)
      ;(function() {
        CKEDITOR.tools.array.forEach(
          ['top', 'right', 'bottom', 'left'],
          function(a) {
            a = 'margin-' + a
            if (a in g) {
              var b = CKEDITOR.tools.convertToPx(g[a])
              b || u ? (g[a] = b ? b + 'px' : 0) : delete g[a]
            }
          },
        )
      })()
      return CKEDITOR.tools.writeCssText(g)
    },
    createStyleStack: function(a, b, c, d) {
      var e = []
      a.filterChildren(b)
      for (b = a.children.length - 1; 0 <= b; b--)
        e.unshift(a.children[b]), a.children[b].remove()
      k.sortStyles(a)
      b = m.parseCssText(k.normalizedStyles(a, c))
      c = a
      var f = 'span' === a.name,
        g
      for (g in b)
        if (
          !g.match(
            d ||
              /margin((?!-)|-left|-top|-bottom|-right)|text-indent|text-align|width|border|padding/i,
          )
        )
          if (f) f = !1
          else {
            var q = new CKEDITOR.htmlParser.element('span')
            q.attributes.style = g + ':' + b[g]
            c.add(q)
            c = q
            delete b[g]
          }
      CKEDITOR.tools.isEmpty(b)
        ? delete a.attributes.style
        : (a.attributes.style = CKEDITOR.tools.writeCssText(b))
      for (b = 0; b < e.length; b++) c.add(e[b])
    },
    sortStyles: function(a) {
      for (
        var b = ['border', 'border-bottom', 'font-size', 'background'],
          c = m.parseCssText(a.attributes.style),
          d = m.object.keys(c),
          e = [],
          f = [],
          g = 0;
        g < d.length;
        g++
      )
        -1 !== m.indexOf(b, d[g].toLowerCase()) ? e.push(d[g]) : f.push(d[g])
      e.sort(function(a, c) {
        var e = m.indexOf(b, a.toLowerCase()),
          d = m.indexOf(b, c.toLowerCase())
        return e - d
      })
      d = [].concat(e, f)
      e = {}
      for (g = 0; g < d.length; g++) e[d[g]] = c[d[g]]
      a.attributes.style = CKEDITOR.tools.writeCssText(e)
    },
    pushStylesLower: function(a, b, c) {
      if (!a.attributes.style || 0 === a.children.length) return !1
      b = b || {}
      var d = {
          'list-style-type': !0,
          width: !0,
          height: !0,
          border: !0,
          'border-': !0,
        },
        e = m.parseCssText(a.attributes.style),
        f
      for (f in e)
        if (
          !(
            f.toLowerCase() in d ||
            d[f.toLowerCase().replace(/\-.*$/, '-')] ||
            f.toLowerCase() in b
          )
        ) {
          for (var g = !1, q = 0; q < a.children.length; q++) {
            var l = a.children[q]
            if (l.type === CKEDITOR.NODE_TEXT && c) {
              var h = new CKEDITOR.htmlParser.element('span')
              h.setHtml(l.value)
              l.replaceWith(h)
              l = h
            }
            l.type === CKEDITOR.NODE_ELEMENT &&
              ((g = !0), k.setStyle(l, f, e[f]))
          }
          g && delete e[f]
        }
      a.attributes.style = CKEDITOR.tools.writeCssText(e)
      return !0
    },
    inliner: {
      filtered: 'break-before break-after break-inside page-break page-break-before page-break-after page-break-inside'.split(
        ' ',
      ),
      parse: function(a) {
        function b(a) {
          var b = new CKEDITOR.dom.element('style'),
            c = new CKEDITOR.dom.element('iframe')
          c.hide()
          CKEDITOR.document.getBody().append(c)
          c.$.contentDocument.documentElement.appendChild(b.$)
          b.$.textContent = a
          c.remove()
          return b.$.sheet
        }
        function c(a) {
          var b = a.indexOf('{'),
            c = a.indexOf('}')
          return d(a.substring(b + 1, c), !0)
        }
        var d = CKEDITOR.tools.parseCssText,
          e = CKEDITOR.plugins.pastefromword.styles.inliner.filter,
          f = a.is ? a.$.sheet : b(a)
        a = []
        var g
        if (f)
          for (f = f.cssRules, g = 0; g < f.length; g++)
            f[g].type === window.CSSRule.STYLE_RULE &&
              a.push({
                selector: f[g].selectorText,
                styles: e(c(f[g].cssText)),
              })
        return a
      },
      filter: function(a) {
        var b = CKEDITOR.plugins.pastefromword.styles.inliner.filtered,
          c = m.array.indexOf,
          d = {},
          e
        for (e in a) -1 === c(b, e) && (d[e] = a[e])
        return d
      },
      sort: function(a) {
        return a.sort(
          (function(a) {
            var c = CKEDITOR.tools.array.map(a, function(a) {
              return a.selector
            })
            return function(a, b) {
              var f = -1 !== ('' + a.selector).indexOf('.') ? 1 : 0,
                f = (-1 !== ('' + b.selector).indexOf('.') ? 1 : 0) - f
              return 0 !== f ? f : c.indexOf(b.selector) - c.indexOf(a.selector)
            }
          })(a),
        )
      },
      inline: function(a) {
        var b = CKEDITOR.plugins.pastefromword.styles.inliner.parse,
          c = CKEDITOR.plugins.pastefromword.styles.inliner.sort,
          d = (function(a) {
            a = new DOMParser().parseFromString(a, 'text/html')
            return new CKEDITOR.dom.document(a)
          })(a)
        a = d.find('style')
        c = c(
          (function(a) {
            var c = [],
              d
            for (d = 0; d < a.count(); d++) c = c.concat(b(a.getItem(d)))
            return c
          })(a),
        )
        CKEDITOR.tools.array.forEach(c, function(a) {
          var b = a.styles
          a = d.find(a.selector)
          var c, h, l
          x(b)
          for (l = 0; l < a.count(); l++)
            (c = a.getItem(l)),
              (h = CKEDITOR.tools.parseCssText(c.getAttribute('style'))),
              x(h),
              (h = CKEDITOR.tools.extend({}, h, b)),
              c.setAttribute('style', CKEDITOR.tools.writeCssText(h))
        })
        return d
      },
    },
  }
  k = CKEDITOR.plugins.pastefromword.styles
  CKEDITOR.plugins.pastefromword.lists = {
    thisIsAListItem: function(a, b) {
      return r.isEdgeListItem(a, b) ||
        (b.attributes.style &&
          b.attributes.style.match(/mso\-list:\s?l\d/) &&
          'li' !== b.parent.name) ||
        b.attributes['cke-dissolved'] ||
        b.getHtml().match(/<!\-\-\[if !supportLists]\-\->/)
        ? !0
        : !1
    },
    convertToFakeListItem: function(a, b) {
      r.isDegenerateListItem(a, b) && r.assignListLevels(a, b)
      this.getListItemInfo(b)
      if (!b.attributes['cke-dissolved']) {
        var c
        b.forEach(function(a) {
          !c &&
            'img' == a.name &&
            a.attributes['cke-ignored'] &&
            '*' == a.attributes.alt &&
            ((c = '·'), a.remove())
        }, CKEDITOR.NODE_ELEMENT)
        b.forEach(function(a) {
          c || a.value.match(/^ /) || (c = a.value)
        }, CKEDITOR.NODE_TEXT)
        if ('undefined' == typeof c) return
        b.attributes['cke-symbol'] = c.replace(/(?: |&nbsp;).*$/, '')
        h.removeSymbolText(b)
      }
      var d = b.attributes && m.parseCssText(b.attributes.style)
      if (d['margin-left']) {
        var e = d['margin-left'],
          f = b.attributes['cke-list-level']
        ;(e = Math.max(CKEDITOR.tools.convertToPx(e) - 40 * f, 0))
          ? (d['margin-left'] = e + 'px')
          : delete d['margin-left']
        b.attributes.style = CKEDITOR.tools.writeCssText(d)
      }
      b.name = 'cke:li'
    },
    convertToRealListItems: function(a) {
      var b = []
      a.forEach(
        function(a) {
          'cke:li' == a.name && ((a.name = 'li'), b.push(a))
        },
        CKEDITOR.NODE_ELEMENT,
        !1,
      )
      return b
    },
    removeSymbolText: function(a) {
      var b = a.attributes['cke-symbol'],
        c = a.findOne(function(a) {
          return a.value && -1 < a.value.indexOf(b)
        }, !0),
        d
      c &&
        ((c.value = c.value.replace(b, '')),
        (d = c.parent),
        d.getHtml().match(/^(\s|&nbsp;)*$/) && d !== a
          ? d.remove()
          : c.value || c.remove())
    },
    setListSymbol: function(a, b, c) {
      c = c || 1
      var d = m.parseCssText(a.attributes.style)
      if ('ol' == a.name) {
        if (a.attributes.type || d['list-style-type']) return
        var e = {
            '[ivx]': 'lower-roman',
            '[IVX]': 'upper-roman',
            '[a-z]': 'lower-alpha',
            '[A-Z]': 'upper-alpha',
            '\\d': 'decimal',
          },
          f
        for (f in e)
          if (h.getSubsectionSymbol(b).match(new RegExp(f))) {
            d['list-style-type'] = e[f]
            break
          }
        a.attributes['cke-list-style-type'] = d['list-style-type']
      } else
        (e = { '·': 'disc', o: 'circle', '§': 'square' }),
          !d['list-style-type'] && e[b] && (d['list-style-type'] = e[b])
      h.setListSymbol.removeRedundancies(d, c)
      ;(a.attributes.style = CKEDITOR.tools.writeCssText(d)) ||
        delete a.attributes.style
    },
    setListStart: function(a) {
      for (var b = [], c = 0, d = 0; d < a.children.length; d++)
        b.push(a.children[d].attributes['cke-symbol'] || '')
      b[0] || c++
      switch (a.attributes['cke-list-style-type']) {
        case 'lower-roman':
        case 'upper-roman':
          a.attributes.start = h.toArabic(h.getSubsectionSymbol(b[c])) - c
          break
        case 'lower-alpha':
        case 'upper-alpha':
          a.attributes.start =
            h
              .getSubsectionSymbol(b[c])
              .replace(/\W/g, '')
              .toLowerCase()
              .charCodeAt(0) -
            96 -
            c
          break
        case 'decimal':
          a.attributes.start =
            parseInt(h.getSubsectionSymbol(b[c]), 10) - c || 1
      }
      '1' == a.attributes.start && delete a.attributes.start
      delete a.attributes['cke-list-style-type']
    },
    numbering: {
      toNumber: function(a, b) {
        function c(a) {
          a = a.toUpperCase()
          for (var b = 1, c = 1; 0 < a.length; c *= 26)
            (b +=
              'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.indexOf(a.charAt(a.length - 1)) * c),
              (a = a.substr(0, a.length - 1))
          return b
        }
        function d(a) {
          var b = [
            [1e3, 'M'],
            [900, 'CM'],
            [500, 'D'],
            [400, 'CD'],
            [100, 'C'],
            [90, 'XC'],
            [50, 'L'],
            [40, 'XL'],
            [10, 'X'],
            [9, 'IX'],
            [5, 'V'],
            [4, 'IV'],
            [1, 'I'],
          ]
          a = a.toUpperCase()
          for (var c = b.length, d = 0, h = 0; h < c; ++h)
            for (
              var k = b[h], t = k[1].length;
              a.substr(0, t) == k[1];
              a = a.substr(t)
            )
              d += k[0]
          return d
        }
        return 'decimal' == b
          ? Number(a)
          : 'upper-roman' == b || 'lower-roman' == b
          ? d(a.toUpperCase())
          : 'lower-alpha' == b || 'upper-alpha' == b
          ? c(a)
          : 1
      },
      getStyle: function(a) {
        a = a.slice(0, 1)
        var b = {
          i: 'lower-roman',
          v: 'lower-roman',
          x: 'lower-roman',
          l: 'lower-roman',
          m: 'lower-roman',
          I: 'upper-roman',
          V: 'upper-roman',
          X: 'upper-roman',
          L: 'upper-roman',
          M: 'upper-roman',
        }[a]
        b ||
          ((b = 'decimal'),
          a.match(/[a-z]/) && (b = 'lower-alpha'),
          a.match(/[A-Z]/) && (b = 'upper-alpha'))
        return b
      },
    },
    getSubsectionSymbol: function(a) {
      return (a.match(/([\da-zA-Z]+).?$/) || ['placeholder', '1'])[1]
    },
    setListDir: function(a) {
      var b = 0,
        c = 0
      a.forEach(function(a) {
        'li' == a.name &&
          ('rtl' == (a.attributes.dir || a.attributes.DIR || '').toLowerCase()
            ? c++
            : b++)
      }, CKEDITOR.ELEMENT_NODE)
      c > b && (a.attributes.dir = 'rtl')
    },
    createList: function(a) {
      return (a.attributes['cke-symbol'].match(/([\da-np-zA-NP-Z]).?/) || [])[1]
        ? new CKEDITOR.htmlParser.element('ol')
        : new CKEDITOR.htmlParser.element('ul')
    },
    createLists: function(a) {
      function b(a) {
        return CKEDITOR.tools.array.reduce(
          a,
          function(a, b) {
            if (b.attributes && b.attributes.style)
              var c = CKEDITOR.tools.parseCssText(b.attributes.style)[
                'margin-left'
              ]
            return c ? a + parseInt(c, 10) : a
          },
          0,
        )
      }
      var c,
        d,
        e,
        f = h.convertToRealListItems(a)
      if (0 === f.length) return []
      var g = h.groupLists(f)
      for (a = 0; a < g.length; a++) {
        var k = g[a],
          l = k[0]
        for (e = 0; e < k.length; e++)
          if (1 == k[e].attributes['cke-list-level']) {
            l = k[e]
            break
          }
        var l = [h.createList(l)],
          n = l[0],
          t = [l[0]]
        n.insertBefore(k[0])
        for (e = 0; e < k.length; e++) {
          c = k[e]
          for (d = c.attributes['cke-list-level']; d > l.length; ) {
            var m = h.createList(c),
              u = n.children
            0 < u.length
              ? u[u.length - 1].add(m)
              : ((u = new CKEDITOR.htmlParser.element('li', {
                  style: 'list-style-type:none',
                })),
                u.add(m),
                n.add(u))
            l.push(m)
            t.push(m)
            n = m
            d == l.length && h.setListSymbol(m, c.attributes['cke-symbol'], d)
          }
          for (; d < l.length; )
            l.pop(),
              (n = l[l.length - 1]),
              d == l.length && h.setListSymbol(n, c.attributes['cke-symbol'], d)
          c.remove()
          n.add(c)
        }
        l[0].children.length &&
          ((e = l[0].children[0].attributes['cke-symbol']),
          !e &&
            1 < l[0].children.length &&
            (e = l[0].children[1].attributes['cke-symbol']),
          e && h.setListSymbol(l[0], e))
        for (e = 0; e < t.length; e++) h.setListStart(t[e])
        for (e = 0; e < k.length; e++) this.determineListItemValue(k[e])
      }
      CKEDITOR.tools.array.forEach(f, function(a) {
        for (var c = [], d = a.parent; d; )
          'li' === d.name && c.push(d), (d = d.parent)
        var c = b(c),
          e
        c &&
          ((a.attributes = a.attributes || {}),
          (d = CKEDITOR.tools.parseCssText(a.attributes.style)),
          (e = d['margin-left'] || 0),
          (e = Math.max(parseInt(e, 10) - c, 0))
            ? (d['margin-left'] = e + 'px')
            : delete d['margin-left'],
          (a.attributes.style = CKEDITOR.tools.writeCssText(d)))
      })
      return f
    },
    cleanup: function(a) {
      var b = [
          'cke-list-level',
          'cke-symbol',
          'cke-list-id',
          'cke-indentation',
          'cke-dissolved',
        ],
        c,
        d
      for (c = 0; c < a.length; c++)
        for (d = 0; d < b.length; d++) delete a[c].attributes[b[d]]
    },
    determineListItemValue: function(a) {
      if ('ol' === a.parent.name) {
        var b = this.calculateValue(a),
          c = a.attributes['cke-symbol'].match(/[a-z0-9]+/gi),
          d
        c &&
          ((c = c[c.length - 1]),
          (d =
            a.parent.attributes['cke-list-style-type'] ||
            this.numbering.getStyle(c)),
          (c = this.numbering.toNumber(c, d)),
          c !== b && (a.attributes.value = c))
      }
    },
    calculateValue: function(a) {
      if (!a.parent) return 1
      var b = a.parent
      a = a.getIndex()
      var c = null,
        d,
        e,
        f
      for (f = a; 0 <= f && null === c; f--)
        (e = b.children[f]),
          e.attributes &&
            void 0 !== e.attributes.value &&
            ((d = f), (c = parseInt(e.attributes.value, 10)))
      null === c &&
        ((c =
          void 0 !== b.attributes.start ? parseInt(b.attributes.start, 10) : 1),
        (d = 0))
      return c + (a - d)
    },
    dissolveList: function(a) {
      function b(a) {
        return 50 <= a
          ? 'l' + b(a - 50)
          : 40 <= a
          ? 'xl' + b(a - 40)
          : 10 <= a
          ? 'x' + b(a - 10)
          : 9 == a
          ? 'ix'
          : 5 <= a
          ? 'v' + b(a - 5)
          : 4 == a
          ? 'iv'
          : 1 <= a
          ? 'i' + b(a - 1)
          : ''
      }
      function c(a, b) {
        function c(b, d) {
          return b && b.parent
            ? a(b.parent)
              ? c(b.parent, d + 1)
              : c(b.parent, d)
            : d
        }
        return c(b, 0)
      }
      var d = function(a) {
          return function(b) {
            return b.name == a
          }
        },
        e = function(a) {
          return d('ul')(a) || d('ol')(a)
        },
        f = CKEDITOR.tools.array,
        g = [],
        h,
        l
      a.forEach(
        function(a) {
          g.push(a)
        },
        CKEDITOR.NODE_ELEMENT,
        !1,
      )
      h = f.filter(g, d('li'))
      var n = f.filter(g, e)
      f.forEach(n, function(a) {
        var h = a.attributes.type,
          g = parseInt(a.attributes.start, 10) || 1,
          k = c(e, a) + 1
        h || (h = m.parseCssText(a.attributes.style)['list-style-type'])
        f.forEach(f.filter(a.children, d('li')), function(c, d) {
          var e
          switch (h) {
            case 'disc':
              e = '·'
              break
            case 'circle':
              e = 'o'
              break
            case 'square':
              e = '§'
              break
            case '1':
            case 'decimal':
              e = g + d + '.'
              break
            case 'a':
            case 'lower-alpha':
              e = String.fromCharCode(97 + g - 1 + d) + '.'
              break
            case 'A':
            case 'upper-alpha':
              e = String.fromCharCode(65 + g - 1 + d) + '.'
              break
            case 'i':
            case 'lower-roman':
              e = b(g + d) + '.'
              break
            case 'I':
            case 'upper-roman':
              e = b(g + d).toUpperCase() + '.'
              break
            default:
              e = 'ul' == a.name ? '·' : g + d + '.'
          }
          c.attributes['cke-symbol'] = e
          c.attributes['cke-list-level'] = k
        })
      })
      h = f.reduce(
        h,
        function(a, b) {
          var c = b.children[0]
          if (
            c &&
            c.name &&
            c.attributes.style &&
            c.attributes.style.match(/mso-list:/i)
          ) {
            k.pushStylesLower(b, { 'list-style-type': !0, display: !0 })
            var d = m.parseCssText(c.attributes.style, !0)
            k.setStyle(b, 'mso-list', d['mso-list'], !0)
            k.setStyle(c, 'mso-list', '')
            delete b['cke-list-level']
            ;(c = d.display ? 'display' : d.DISPLAY ? 'DISPLAY' : '') &&
              k.setStyle(b, 'display', d[c], !0)
          }
          if (1 === b.children.length && e(b.children[0])) return a
          b.name = 'p'
          b.attributes['cke-dissolved'] = !0
          a.push(b)
          return a
        },
        [],
      )
      for (l = h.length - 1; 0 <= l; l--) h[l].insertAfter(a)
      for (l = n.length - 1; 0 <= l; l--) delete n[l].name
    },
    groupLists: function(a) {
      var b,
        c,
        d = [[a[0]]],
        e = d[0]
      c = a[0]
      c.attributes['cke-indentation'] =
        c.attributes['cke-indentation'] || h.getElementIndentation(c)
      for (b = 1; b < a.length; b++) {
        c = a[b]
        var f = a[b - 1]
        c.attributes['cke-indentation'] =
          c.attributes['cke-indentation'] || h.getElementIndentation(c)
        c.previous !== f && (h.chopDiscontinuousLists(e, d), d.push((e = [])))
        e.push(c)
      }
      h.chopDiscontinuousLists(e, d)
      return d
    },
    chopDiscontinuousLists: function(a, b) {
      for (var c = {}, d = [[]], e, f = 0; f < a.length; f++) {
        var g = c[a[f].attributes['cke-list-level']],
          k = this.getListItemInfo(a[f]),
          l,
          n
        g
          ? ((n = g.type.match(/alpha/) && 7 == g.index ? 'alpha' : n),
            (n =
              'o' == a[f].attributes['cke-symbol'] && 14 == g.index
                ? 'alpha'
                : n),
            (l = h.getSymbolInfo(a[f].attributes['cke-symbol'], n)),
            (k = this.getListItemInfo(a[f])),
            (g.type != l.type ||
              (e && k.id != e.id && !this.isAListContinuation(a[f]))) &&
              d.push([]))
          : (l = h.getSymbolInfo(a[f].attributes['cke-symbol']))
        for (
          e = parseInt(a[f].attributes['cke-list-level'], 10) + 1;
          20 > e;
          e++
        )
          c[e] && delete c[e]
        c[a[f].attributes['cke-list-level']] = l
        d[d.length - 1].push(a[f])
        e = k
      }
      ;[].splice.apply(b, [].concat([m.indexOf(b, a), 1], d))
    },
    isAListContinuation: function(a) {
      var b = a
      do
        if ((b = b.previous) && b.type === CKEDITOR.NODE_ELEMENT) {
          if (void 0 === b.attributes['cke-list-level']) break
          if (b.attributes['cke-list-level'] === a.attributes['cke-list-level'])
            return b.attributes['cke-list-id'] === a.attributes['cke-list-id']
        }
      while (b)
      return !1
    },
    getElementIndentation: function(a) {
      a = m.parseCssText(a.attributes.style)
      if (a.margin || a.MARGIN) {
        a.margin = a.margin || a.MARGIN
        var b = { styles: { margin: a.margin } }
        CKEDITOR.filter.transformationsTools.splitMarginShorthand(b)
        a['margin-left'] = b.styles['margin-left']
      }
      return parseInt(m.convertToPx(a['margin-left'] || '0px'), 10)
    },
    toArabic: function(a) {
      return a.match(/[ivxl]/i)
        ? a.match(/^l/i)
          ? 50 + h.toArabic(a.slice(1))
          : a.match(/^lx/i)
          ? 40 + h.toArabic(a.slice(1))
          : a.match(/^x/i)
          ? 10 + h.toArabic(a.slice(1))
          : a.match(/^ix/i)
          ? 9 + h.toArabic(a.slice(2))
          : a.match(/^v/i)
          ? 5 + h.toArabic(a.slice(1))
          : a.match(/^iv/i)
          ? 4 + h.toArabic(a.slice(2))
          : a.match(/^i/i)
          ? 1 + h.toArabic(a.slice(1))
          : h.toArabic(a.slice(1))
        : 0
    },
    getSymbolInfo: function(a, b) {
      var c = a.toUpperCase() == a ? 'upper-' : 'lower-',
        d = { '·': ['disc', -1], o: ['circle', -2], '§': ['square', -3] }
      if (a in d || (b && b.match(/(disc|circle|square)/)))
        return { index: d[a][1], type: d[a][0] }
      if (a.match(/\d/))
        return {
          index: a ? parseInt(h.getSubsectionSymbol(a), 10) : 0,
          type: 'decimal',
        }
      a = a.replace(/\W/g, '').toLowerCase()
      return (!b && a.match(/[ivxl]+/i)) || (b && 'alpha' != b) || 'roman' == b
        ? { index: h.toArabic(a), type: c + 'roman' }
        : a.match(/[a-z]/i)
        ? { index: a.charCodeAt(0) - 97, type: c + 'alpha' }
        : { index: -1, type: 'disc' }
    },
    getListItemInfo: function(a) {
      if (void 0 !== a.attributes['cke-list-id'])
        return {
          id: a.attributes['cke-list-id'],
          level: a.attributes['cke-list-level'],
        }
      var b = m.parseCssText(a.attributes.style)['mso-list'],
        c = { id: '0', level: '1' }
      b &&
        ((b += ' '),
        (c.level = b.match(/level(.+?)\s+/)[1]),
        (c.id = b.match(/l(\d+?)\s+/)[1]))
      a.attributes['cke-list-level'] =
        void 0 !== a.attributes['cke-list-level']
          ? a.attributes['cke-list-level']
          : c.level
      a.attributes['cke-list-id'] = c.id
      return c
    },
  }
  h = CKEDITOR.plugins.pastefromword.lists
  CKEDITOR.plugins.pastefromword.images = {
    extractFromRtf: function(a) {
      var b = [],
        c = /\{\\pict[\s\S]+?\\bliptag\-?\d+(\\blipupi\-?\d+)?(\{\\\*\\blipuid\s?[\da-fA-F]+)?[\s\}]*?/,
        d
      a = a.match(new RegExp('(?:(' + c.source + '))([\\da-fA-F\\s]+)\\}', 'g'))
      if (!a) return b
      for (var e = 0; e < a.length; e++)
        if (c.test(a[e])) {
          if (-1 !== a[e].indexOf('\\pngblip')) d = 'image/png'
          else if (-1 !== a[e].indexOf('\\jpegblip')) d = 'image/jpeg'
          else continue
          b.push({
            hex: d ? a[e].replace(c, '').replace(/[^\da-fA-F]/g, '') : null,
            type: d,
          })
        }
      return b
    },
    extractTagsFromHtml: function(a) {
      for (var b = /<img[^>]+src="([^"]+)[^>]+/g, c = [], d; (d = b.exec(a)); )
        c.push(d[1])
      return c
    },
  }
  CKEDITOR.plugins.pastefromword.heuristics = {
    isEdgeListItem: function(a, b) {
      if (!CKEDITOR.env.edge || !a.config.pasteFromWord_heuristicsEdgeList)
        return !1
      var c = ''
      b.forEach &&
        b.forEach(function(a) {
          c += a.value
        }, CKEDITOR.NODE_TEXT)
      return c.match(/^(?: |&nbsp;)*\(?[a-zA-Z0-9]+?[\.\)](?: |&nbsp;){2,}/)
        ? !0
        : r.isDegenerateListItem(a, b)
    },
    cleanupEdgeListItem: function(a) {
      var b = !1
      a.forEach(function(a) {
        b ||
          ((a.value = a.value.replace(/^(?:&nbsp;|[\s])+/, '')),
          a.value.length && (b = !0))
      }, CKEDITOR.NODE_TEXT)
    },
    isDegenerateListItem: function(a, b) {
      return (
        !!b.attributes['cke-list-level'] ||
        (b.attributes.style &&
          !b.attributes.style.match(/mso\-list/) &&
          !!b.find(function(a) {
            if (
              a.type == CKEDITOR.NODE_ELEMENT &&
              b.name.match(/h\d/i) &&
              a.getHtml().match(/^[a-zA-Z0-9]+?[\.\)]$/)
            )
              return !0
            var d = m.parseCssText(a.attributes && a.attributes.style, !0)
            if (!d) return !1
            var e = d['font-family'] || ''
            return (
              ((d.font || d['font-size'] || '').match(/7pt/i) &&
                !!a.previous) ||
              e.match(/symbol/i)
            )
          }, !0).length)
      )
    },
    assignListLevels: function(a, b) {
      if (!b.attributes || void 0 === b.attributes['cke-list-level']) {
        for (
          var c = [h.getElementIndentation(b)],
            d = [b],
            e = [],
            f = CKEDITOR.tools.array,
            g = f.map;
          b.next &&
          b.next.attributes &&
          !b.next.attributes['cke-list-level'] &&
          r.isDegenerateListItem(a, b.next);

        )
          (b = b.next), c.push(h.getElementIndentation(b)), d.push(b)
        var k = g(c, function(a, b) {
            return 0 === b ? 0 : a - c[b - 1]
          }),
          l = this.guessIndentationStep(
            f.filter(c, function(a) {
              return 0 !== a
            }),
          ),
          e = g(c, function(a) {
            return Math.round(a / l)
          })
        ;-1 !== f.indexOf(e, 0) &&
          (e = g(e, function(a) {
            return a + 1
          }))
        f.forEach(d, function(a, b) {
          a.attributes['cke-list-level'] = e[b]
        })
        return { indents: c, levels: e, diffs: k }
      }
    },
    guessIndentationStep: function(a) {
      return a.length ? Math.min.apply(null, a) : null
    },
    correctLevelShift: function(a) {
      if (this.isShifted(a)) {
        var b = CKEDITOR.tools.array.filter(a.children, function(a) {
            return 'ul' == a.name || 'ol' == a.name
          }),
          c = CKEDITOR.tools.array.reduce(
            b,
            function(a, b) {
              return (b.children &&
              1 == b.children.length &&
              r.isShifted(b.children[0])
                ? [b]
                : b.children
              ).concat(a)
            },
            [],
          )
        CKEDITOR.tools.array.forEach(b, function(a) {
          a.remove()
        })
        CKEDITOR.tools.array.forEach(c, function(b) {
          a.add(b)
        })
        delete a.name
      }
    },
    isShifted: function(a) {
      return 'li' !== a.name
        ? !1
        : 0 ===
            CKEDITOR.tools.array.filter(a.children, function(a) {
              return a.name &&
                ('ul' == a.name ||
                  'ol' == a.name ||
                  ('p' == a.name && 0 === a.children.length))
                ? !1
                : !0
            }).length
    },
  }
  r = CKEDITOR.plugins.pastefromword.heuristics
  h.setListSymbol.removeRedundancies = function(a, b) {
    ;((1 === b && 'disc' === a['list-style-type']) ||
      'decimal' === a['list-style-type']) &&
      delete a['list-style-type']
  }
  CKEDITOR.plugins.pastefromword.createAttributeStack = z
  CKEDITOR.config.pasteFromWord_heuristicsEdgeList = !0
})()
