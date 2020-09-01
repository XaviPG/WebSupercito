
/* global describe, it, jsPDF, expect */

describe('Module: FileLoad', () => {
  if (typeof global === 'object' && global.isNode === true) {
    return;
  }

  var successURL = '/base/spec/reference/success.txt';
  it('should load a file (sync)', () => {
    const doc = jsPDF()
    var file = doc.loadFile(successURL, undefined, undefined);
    expect(file).toEqual('success');
  })

  it('should fail to load a file (sync)', () => {
    const doc = jsPDF()
    var file = doc.loadFile('fail.txt', undefined, undefined);
    expect(file).toEqual(undefined);
  })

  
  it('should load a file (async)', (done) => {
    const doc = jsPDF()
    doc.loadFile(successURL, false, function (data) {
      expect(data).toEqual('success');
      done();
    });
  })

  it('should fail to load a file (async)', (done) => {
    const doc = jsPDF()
    doc.loadFile('fail.txt', false, function (data) {
      expect(data).toEqual(undefined);
      done();
    });
  })
})
